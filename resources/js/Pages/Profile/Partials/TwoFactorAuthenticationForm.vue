<script setup>
import { ref, computed, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import JetActionSection from '@/Components/Jetstream/ActionSection.vue'
import JetButton from '@/Components/Base/Button.vue'
import JetConfirmsPassword from '@/Components/Jetstream/ConfirmsPassword.vue'
import JetDangerButton from '@/Components/Jetstream/DangerButton.vue'
import JetInput from '@/Components/Base/Input.vue'
import JetInputError from '@/Components/Base/InputError.vue'
import JetLabel from '@/Components/Base/Label.vue'
import JetSecondaryButton from '@/Components/Jetstream/SecondaryButton.vue'

const props = defineProps({
  requiresConfirmation: Boolean,
})

const enabling = ref(false)
const confirming = ref(false)
const disabling = ref(false)
const qrCode = ref(null)
const setupKey = ref(null)
const recoveryCodes = ref([])

const confirmationForm = useForm({
  code: '',
})

const twoFactorEnabled = computed(
  () => ! enabling.value && usePage().props.user?.two_factor_enabled,
)

watch(twoFactorEnabled, () => {
  if (! twoFactorEnabled.value) {
    confirmationForm.reset()
    confirmationForm.clearErrors()
  }
})

const enableTwoFactorAuthentication = () => {
  enabling.value = true

  router.post('/user/two-factor-authentication', {}, {
    preserveScroll: true,
    onSuccess: () => Promise.all([
      showQrCode(),
      showSetupKey(),
      showRecoveryCodes(),
    ]),
    onFinish: () => {
      enabling.value = false
      confirming.value = props.requiresConfirmation
    },
  })
}

const showQrCode = () => {
  return axios.get('/user/two-factor-qr-code').then(response => {
    qrCode.value = response.data.svg
  })
}

const showSetupKey = () => {
  return axios.get('/user/two-factor-secret-key').then(response => {
    setupKey.value = response.data.secretKey
  })
}

const showRecoveryCodes = () => {
  return axios.get('/user/two-factor-recovery-codes').then(response => {
    recoveryCodes.value = response.data
  })
}

const confirmTwoFactorAuthentication = () => {
  confirmationForm.post('/user/confirmed-two-factor-authentication', {
    errorBag: 'confirmTwoFactorAuthentication',
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      confirming.value = false
      qrCode.value = null
      setupKey.value = null
    },
  })
}

const regenerateRecoveryCodes = () => {
  axios
    .post('/user/two-factor-recovery-codes')
    .then(() => showRecoveryCodes())
}

const disableTwoFactorAuthentication = () => {
  disabling.value = true

  router.delete('/user/two-factor-authentication', {
    preserveScroll: true,
    onSuccess: () => {
      disabling.value = false
      confirming.value = false
    },
  })
}
</script>

<template>
  <JetActionSection>
    <template #title>
      احراز هویت دو عاملی
    </template>

    <template #description>
      با استفاده از احراز هویت دو عاملی، امنیت بیشتری را به حساب خود اضافه کنید.
    </template>

    <template #content>
      <h3 v-if="twoFactorEnabled && ! confirming" class="text-lg font-medium text-gray-900">
        شما احراز هویت دو عاملی را فعال کرده اید.
      </h3>

      <h3 v-else-if="twoFactorEnabled && confirming" class="text-lg font-medium text-gray-900">
        فعال کردن احراز هویت دو عاملی را به پایان برسانید.
      </h3>

      <h3 v-else class="text-lg font-medium text-gray-900">
        شما احراز هویت دو عاملی را فعال نکرده اید.
      </h3>

      <div class="mt-3 max-w-xl text-sm text-gray-600">
        <p>
          هنگامی که احراز هویت دو عاملی فعال باشد، در حین احراز هویت از شما خواسته می شود که یک نشانه امن و تصادفی داشته باشید. می توانید این نشانه را از برنامه Google Authenticator گوشی خود بازیابی کنید.
        </p>
      </div>

      <div v-if="twoFactorEnabled">
        <div v-if="qrCode">
          <div class="mt-4 max-w-xl text-sm text-gray-600">
            <p v-if="confirming" class="font-semibold">
              برای پایان دادن به فعال کردن احراز هویت دو عاملی، کد QR زیر را با استفاده از برنامه احراز هویت گوشی خود اسکن کنید یا کلید تنظیم را وارد کرده و کد OTP تولید شده را ارائه دهید.
            </p>

            <p v-else>
              احراز هویت دو عاملی اکنون فعال است. کد QR زیر را با استفاده از برنامه احراز هویت گوشی خود اسکن کنید یا کلید تنظیم را وارد کنید.
            </p>
          </div>

          <div class="mt-4" v-html="qrCode" />

          <div v-if="setupKey" class="mt-4 max-w-xl text-sm text-gray-600">
            <p class="font-semibold">
              کلید راه اندازی: <span v-html="setupKey" />
            </p>
          </div>

          <div v-if="confirming" class="mt-4">
            <JetLabel for="code" value="کد" />

            <JetInput
              id="code"
              v-model="confirmationForm.code"
              type="text"
              name="code"
              class="block mt-1 w-1/2"
              inputmode="numeric"
              autofocus
              autocomplete="one-time-code"
              @keyup.enter="confirmTwoFactorAuthentication"
            />

            <JetInputError :message="confirmationForm.errors.code" class="mt-2" />
          </div>
        </div>

        <div v-if="recoveryCodes.length > 0 && ! confirming">
          <div class="mt-4 max-w-xl text-sm text-gray-600">
            <p class="font-semibold">
              این کدهای بازیابی را در یک برنامه مدیریت رمز عبور ایمن ذخیره کنید. اگر دستگاه احراز هویت دو عاملی شما گم شود، می توان از آنها برای بازیابی دسترسی به حساب شما استفاده کرد.
            </p>
          </div>

          <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
            <div v-for="code in recoveryCodes" :key="code">
              {{ code }}
            </div>
          </div>
        </div>
      </div>

      <div class="mt-5">
        <div v-if="! twoFactorEnabled">
          <JetConfirmsPassword @confirmed="enableTwoFactorAuthentication">
            <JetButton
              type="button"
              :class="{ 'opacity-25': enabling }"
              :disabled="enabling"
            >
              فعال کردن
            </JetButton>
          </JetConfirmsPassword>
        </div>

        <div v-else>
          <JetConfirmsPassword @confirmed="confirmTwoFactorAuthentication">
            <JetButton
              v-if="confirming"
              type="button"
              class="ltr:mr-3 rtl:ml-3"
              :class="{ 'opacity-25': enabling }"
              :disabled="enabling"
            >
              تایید
            </JetButton>
          </JetConfirmsPassword>

          <JetConfirmsPassword @confirmed="regenerateRecoveryCodes">
            <JetSecondaryButton
              v-if="recoveryCodes.length > 0 && ! confirming"
              class="ltr:mr-3 rtl:ml-3"
            >
              بازیابی کدهای بازیابی
            </JetSecondaryButton>
          </JetConfirmsPassword>

          <JetConfirmsPassword @confirmed="showRecoveryCodes">
            <JetSecondaryButton
              v-if="recoveryCodes.length === 0 && ! confirming"
              class="ltr:mr-3 rtl:ml-3"
            >
              نمایش کدهای بازیابی
            </JetSecondaryButton>
          </JetConfirmsPassword>

          <JetConfirmsPassword @confirmed="disableTwoFactorAuthentication">
            <JetSecondaryButton
              v-if="confirming"
              :class="{ 'opacity-25': disabling }"
              :disabled="disabling"
            >
              لغو کنید
            </JetSecondaryButton>
          </JetConfirmsPassword>

          <JetConfirmsPassword @confirmed="disableTwoFactorAuthentication">
            <JetDangerButton
              v-if="! confirming"
              :class="{ 'opacity-25': disabling }"
              :disabled="disabling"
            >
              غیر فعال کردن
            </JetDangerButton>
          </JetConfirmsPassword>
        </div>
      </div>
    </template>
  </JetActionSection>
</template>

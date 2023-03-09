<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import JetActionSection from '@/Components/Jetstream/ActionSection.vue'
import JetDialogModal from '@/Components/Jetstream/DialogModal.vue'
import JetDangerButton from '@/Components/Jetstream/DangerButton.vue'
import JetInput from '@/Components/Base/Input.vue'
import JetInputError from '@/Components/Base/InputError.vue'
import JetSecondaryButton from '@/Components/Jetstream/SecondaryButton.vue'

const confirmingUserDeletion = ref(false)
const passwordInput = ref(null)

const form = useForm({
  password: '',
})

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true

  setTimeout(() => passwordInput.value.focus(), 250)
}

const deleteUser = () => {
  form.delete(route('current-user.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  })
}

const closeModal = () => {
  confirmingUserDeletion.value = false

  form.reset()
}
</script>

<template>
  <JetActionSection>
    <template #title>
      حذف حساب کاربری
    </template>

    <template #description>
      اکانت خود را برای همیشه حذف کنید
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        پس از حذف حساب شما، تمام منابع و داده های آن برای همیشه حذف می شوند. قبل از حذف حساب خود، لطفاً هر گونه داده یا اطلاعاتی را که می خواهید حفظ کنید دانلود کنید.
      </div>

      <div class="mt-5">
        <JetDangerButton @click="confirmUserDeletion">
          حذف حساب کاربری
        </JetDangerButton>
      </div>

      <!-- Delete Account Confirmation Modal -->
      <!-- TODO: Use ConfirmsPassword modal here and contribute on Jetstream -->
      <JetDialogModal :show="confirmingUserDeletion" @close="closeModal">
        <template #title>
          حذف حساب کاربری
        </template>

        <template #content>
          آیا مطمئن هستید که می خواهید اکانت خود را حذف کنید؟ پس از حذف حساب شما، تمام منابع و داده های آن برای همیشه حذف می شوند. لطفاً رمز عبور خود را وارد کنید تا تأیید کنید که می خواهید حساب خود را برای همیشه حذف کنید.

          <div class="mt-4">
            <JetInput
              ref="passwordInput"
              v-model="form.password"
              type="password"
              class="mt-1 block w-3/4"
              placeholder="رمزعبور"
              @keyup.enter="deleteUser"
            />

            <JetInputError :message="form.errors.password" class="mt-2" />
          </div>
        </template>

        <template #footer>
          <JetSecondaryButton @click="closeModal">
            لغو کنید
          </JetSecondaryButton>

          <JetDangerButton
            class="ltr:ml-3 rtl:mr-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteUser"
          >
            حذف حساب کاربری
          </JetDangerButton>
        </template>
      </JetDialogModal>
    </template>
  </JetActionSection>
</template>

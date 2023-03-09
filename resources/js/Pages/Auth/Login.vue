<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import JetAuthenticationCard from '@/Components/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Components/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Components/Base/Button.vue'
import JetInput from '@/Components/Base/Input.vue'
import JetCheckbox from '@/Components/Base/Checkbox.vue'
import JetLabel from '@/Components/Base/Label.vue'
import JetValidationErrors from '@/Components/Jetstream/ValidationErrors.vue'

defineProps({
  canResetPassword: Boolean,
  status: String,
})

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.transform(data => ({
    ...data,
    remember: form.remember ? 'on' : '',
  })).post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}
</script>

<template>
  <Head title="Log in" />

  <JetAuthenticationCard>
    <template #logo>
      <JetAuthenticationCardLogo />
    </template>

    <JetValidationErrors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <JetLabel for="email" value="ایمیل" />
        <JetInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autofocus
        />
      </div>

      <div class="mt-4">
        <JetLabel for="password" value="کلمه عبور" />
        <JetInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="current-password"
        />
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <JetCheckbox v-model:checked="form.remember" name="remember" />
          <span class="ltr:ml-2 rtl:mr-2 text-sm text-gray-600">مرا به خاطر بسپار</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="underline text-sm text-gray-600 hover:text-gray-900"
        >
          رمز عبور خود را فراموش کرده اید؟
        </Link>

        <JetButton
          class="rtl:mr-4 ltr:ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          ورود
        </JetButton>
      </div>
    </form>
  </JetAuthenticationCard>
</template>

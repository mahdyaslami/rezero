<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import JetAuthenticationCard from '@/Components/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Components/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Components/Jetstream/Button.vue'
import JetInput from '@/Components/Jetstream/Input.vue'
import JetLabel from '@/Components/Jetstream/Label.vue'
import JetValidationErrors from '@/Components/Jetstream/ValidationErrors.vue'

defineProps({
  status: String,
})

const form = useForm({
  email: '',
})

const submit = () => {
  form.post(route('password.email'))
}
</script>

<template>
  <Head title="Forgot Password" />

  <JetAuthenticationCard>
    <template #logo>
      <JetAuthenticationCardLogo />
    </template>

    <div class="mb-4 text-sm text-gray-600">
      رمز عبور خود را فراموش کرده اید؟ مشکلی نیست فقط آدرس ایمیل خود را به ما اطلاع دهید
      و ما یک پیوند بازنشانی رمز عبور را برای شما ایمیل می کنیم
      که به شما امکان می دهد رمز جدیدی را انتخاب کنید.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <JetValidationErrors class="mb-4" />

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

      <div class="flex items-center justify-end mt-4">
        <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          پیوند بازنشانی رمز عبور ایمیل
        </JetButton>
      </div>
    </form>
  </JetAuthenticationCard>
</template>

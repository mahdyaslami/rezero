<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import JetAuthenticationCard from '@/Components/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Components/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Components/Base/Button.vue'
import JetInput from '@/Components/Base/Input.vue'
import JetCheckbox from '@/Components/Base/Checkbox.vue'
import JetLabel from '@/Components/Base/Label.vue'
import JetValidationErrors from '@/Components/Jetstream/ValidationErrors.vue'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>

<template>
  <Head title="Register" />

  <JetAuthenticationCard>
    <template #logo>
      <JetAuthenticationCardLogo />
    </template>

    <JetValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <JetLabel for="name" value="نام" />
        <JetInput
          id="name"
          v-model="form.name"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="name"
        />
      </div>

      <div class="mt-4">
        <JetLabel for="email" value="ایمیل" />
        <JetInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
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
          autocomplete="new-password"
        />
      </div>

      <div class="mt-4">
        <JetLabel for="password_confirmation" value="تکرار کلمه عبور" />
        <JetInput
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />
      </div>

      <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
        <JetLabel for="terms">
          <div class="flex items-center">
            <JetCheckbox
              id="terms"
              v-model:checked="form.terms"
              name="terms"
            />

            <div class="ltr:ml-2 rtl:mr-2">
              من با <a
                target="_blank"
                :href="route('terms.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900"
              >شرایط خدمات</a> و <a
                target="_blank"
                :href="route('policy.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900"
              >سیاست حفظ حریم خصوصی</a> موافقم
            </div>
          </div>
        </JetLabel>
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
          قبلا ثبت نام کرده اید؟
        </Link>

        <JetButton
          class="rtl:mr-4 ltr:ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          ثبت نام
        </JetButton>
      </div>
    </form>
  </JetAuthenticationCard>
</template>

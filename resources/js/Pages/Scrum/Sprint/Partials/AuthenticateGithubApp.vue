<script setup>
import JetActionSection from '@/Jetstream/ActionSection.vue'
import JetButton from '@/Jetstream/Button.vue'

const confirmInGithub = () => {
  document.location = route('github.redirect')
}
</script>

<template>
  <JetActionSection>
    <template #title>
      تایید برنامه از Github
    </template>

    <template #description>
      با تایید استفاده برنامه از Github می توانید ایشو های ریپازیتوری های خود را در اینجا
      ببینید و به کار دوره خود اضافه کنید.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        با زدن دکمه تایید استفاده برنامه از Github شما به یک صفحه خواهید رفت و مشخص می کنید
        که کدام حساب کاربری شما در Github اجازه دسترسی به این برنامه را می دهد.
        ما تنها می خواهیم ایشو های شما رو بخوانیم و هیچ تغییری در منابع شما نخواهیم داد.
      </div>

      <div class="mt-5">
        <JetButton @click="confirmInGithub">
          تایید استفاده برنامه از Github
        </JetButton>
      </div>
    </template>
  </JetActionSection>
</template>

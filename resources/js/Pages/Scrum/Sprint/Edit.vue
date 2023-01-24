
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import AppSelect from '@/Components/Select.vue'
import { ref } from 'vue'

const props = defineProps({
  oauth: {
    type: Boolean,
    default: true
  },
  repos: {
    type: Array,
    required: true
  }
})

const selected = ref(props.repos[0])
</script>

<template>
  <AppLayout title="New Sprint">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <div v-show="!oauth" class="mb-5 text-blue-500">
        شما پیش از استفاده از این ابزار نیاز دارید تا برنامه ما را در گیت هاب خود
        احراز هویت کنید. این کار را می تواند از طریق بخش کاربری انجام دهید.
      </div>

      <AppSelect
        v-model="selected"
        value="name"
        :list="repos"
      />
    </div>
  </AppLayout>
</template>



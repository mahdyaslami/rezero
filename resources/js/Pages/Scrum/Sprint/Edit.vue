
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import AppSelect from '@/Components/Select.vue'
import { ref } from 'vue'
import AuthenticateGithubApp from './Partials/AuthenticateGithubApp.vue'

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

const selected = ref([])
</script>

<template>
  <AppLayout title="New Sprint">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <template v-if="oauth">
        <AppSelect
          v-model="selected"
          value="name"
          class="w-60"
          :list="repos"
          multiple
        />
      </template>

      <AuthenticateGithubApp v-else />
    </div>
  </AppLayout>
</template>




<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

import JetButton from '@/Jetstream/Button.vue'
import SprintItem from './Components/SprintItem.vue'
import { useForm } from '@inertiajs/inertia-vue3'

defineProps({
  sprints: {
    type: Array,
    required: true
  }
})

const form = useForm({})

</script>

<template>
  <AppLayout title="New Sprint">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <div class="mb-5">
        <JetButton @click="form.post(route('sprints.store'))">
          ایجاد کاردوره جدید
        </JetButton>
      </div>
      
      <div class="border bg-white shadow-sm overflow-hidden sm:rounded-md">
        <ul role="list" class="divide-y divide-gray-200">
          <SprintItem
            v-for="sprint in sprints"
            :key="sprint.number"
            :item="sprint"
          />
        </ul>
      </div>
    </div>
  </AppLayout>
</template>



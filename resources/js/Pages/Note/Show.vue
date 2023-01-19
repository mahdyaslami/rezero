<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import NoteForm from './Partials/Form.vue'
import IconTrash from '@/Components/IconTrash.vue'

const props = defineProps({
  notes: {
    type: Object,
    require: true
  }
})

</script>

<template>
  <AppLayout title="Note">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <NoteForm class="mb-5" />

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div v-for="note in notes" :key="note.id"
          class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-gray-500">
          <div class="flex-1 min-w-0">
              <p class="text-sm text-gray-500 truncate mb-5">
                {{ note.content }}
              </p>
              <div>
                <IconTrash class="h-5 w-5" fill="gray" />
              </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NoteForm from './Partials/Form.vue'

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
        <NoteForm />
    </div>
  </AppLayout>
</template>

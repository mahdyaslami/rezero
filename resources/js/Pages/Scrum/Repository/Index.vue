
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import AppTable from '@/Components/Table.vue'
import { computed } from 'vue'
import { router } from '@inertiajs/core'

const props = defineProps({
  repos: {
    type: Array,
    required: true
  },
  selected: {
    type: Array,
    required: true
  },
})

const proxySelected = computed({
  get() {
    return props.repos.filter(r => props.selected.includes(r.id))
  },
  set(repos) {
    router.post(route('repositories.store'), { repos }, {
      preserveScroll: true,
    })
  }
})
</script>

<template>
  <AppLayout title="New Sprint">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <AppTable
        v-model="proxySelected"
        :head="[{key: 'name', title: 'نام مخزن'}]"
        :body="repos"
        selectable
        multiple
      />
    </div>
  </AppLayout>
</template>



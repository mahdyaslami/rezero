
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { computed, onMounted } from 'vue'
import AppTable from '@/Components/Base/Table.vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  issues: {
    type: Array,
    required: true
  },
  selected: {
    type: Array,
    default: () => []
  }
})

const proxySelected = computed({
  get() {
    return props.issues.filter(issue => props.selected.includes(issue.id))
  },
  set(repos) {
    router.post(route('repositories.store'), { repos }, {
      preserveScroll: true,
    })
  }
})

onMounted(() => console.log(props.issues))

</script>

<template>
  <AppLayout title="New Sprint">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <AppTable
        v-model="proxySelected"
        :head="[{slot: 'title', title: 'عنوان'}]"
        :body="issues"
        selectable
        multiple
      >
        <template #title="{ item }">
          <a :href="item.html_url" target="_blank">{{ item.title }}</a>
        </template>
      </AppTable>
    </div>
  </AppLayout>
</template>



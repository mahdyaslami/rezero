
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import AppSelect from '@/Components/Select.vue'
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  repos: {
    type: Array,
    required: true
  },
  selectedRepos: {
    type: Array,
    required: true
  }
})

const proxySelected = computed({
  get() {
    return props.repos.filter((r) => props.selectedRepos.includes(r.id))
  },
  set(val) {
    const fresh = val
    const old = props.repos.filter((r) => props.selectedRepos.includes(r.id))

    if (fresh.length > old.length) {
      router.post(route('repositories.store'), minus(fresh, old).pop(),{
        preserveScroll: true,
      })
    } else {
      router.delete(route('repositories.destroy', [minus(old, fresh).pop().id]), {
        preserveScroll: true,
      })
    }

    function minus(a, b) {
      return a.filter((item) => !b.includes(item))
    }
  }
})
</script>

<template>
  <AppLayout title="New Sprint">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <AppSelect
        v-model="proxySelected"
        value="name"
        class="sm:w-60 px-2"
        :list="repos"
        multiple
      />
    </div>
  </AppLayout>
</template>



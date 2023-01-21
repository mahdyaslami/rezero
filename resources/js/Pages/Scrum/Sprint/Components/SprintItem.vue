<script setup>
import IconListBulleted from '@/Components/IconListBulleted.vue'
import { Link as InertiaLink } from '@inertiajs/inertia-vue3'

defineProps({
  item: {
    type: Object,
    required: true
  }
})

</script>

<template>
  <li>
    <InertiaLink :href="route('sprints.edit', [item.id])" class="block hover:bg-gray-50">
      <div class="px-4 py-4 sm:px-6">
        <div class="flex items-center justify-between">
          <p class="text-sm font-medium text-indigo-600 truncate">
            #{{ Intl.NumberFormat('fa-IR').format(item.number) }}
          </p>
          <div class="ml-2 flex-shrink-0 flex">
            <p
              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                      bg-green-100 text-green-800"
            >
              {{ item.state.toUpperCase() }}
            </p>
          </div>
        </div>
        <div class="mt-2 flex justify-between">
          <div class="flex">
            <p class="flex items-center text-sm text-gray-500">
              <IconListBulleted class="flex-shrink-0 mr-1.5 h-5 w-5 fill-gray-400" aria-hidden="true" />
              <!-- {{ position.department }} -->
            </p>
          </div>
          <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
            <!-- <CalendarIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" /> -->
            <p>
              شروع از
              <time :datetime="item.start_date">
                {{ (new Date(item.start_date)).toLocaleDateString('fa-IR') }}
              </time>
            </p>
          </div>
        </div>
      </div>
    </InertiaLink>
  </li>
</template>
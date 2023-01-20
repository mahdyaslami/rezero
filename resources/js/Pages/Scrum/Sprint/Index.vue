
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import IconListBulleted from '@/Components/IconListBulleted.vue'
import JetButton from '@/Jetstream/Button.vue'
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
          <li v-for="sprint in sprints" :key="sprint.number">
            <a href="#" class="block hover:bg-gray-50">
              <div class="px-4 py-4 sm:px-6">
                <div class="flex items-center justify-between">
                  <p class="text-sm font-medium text-indigo-600 truncate">
                    #{{ Intl.NumberFormat('fa-IR').format(sprint.number) }}
                  </p>
                  <div class="ml-2 flex-shrink-0 flex">
                    <p
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                      bg-green-100 text-green-800"
                    >
                      <!-- {{ position.type }} -->
                    </p>
                  </div>
                </div>
                <div class="mt-2 sm:flex sm:justify-between">
                  <div class="sm:flex">
                    <p class="flex items-center text-sm text-gray-500">
                      <IconListBulleted class="flex-shrink-0 mr-1.5 h-5 w-5 fill-gray-400" aria-hidden="true" />
                      <!-- {{ position.department }} -->
                    </p>
                  </div>
                  <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                    <!-- <CalendarIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" /> -->
                    <p>
                      شروع از
                      <time :datetime="sprint.start_date">
                        {{ (new Date(sprint.start_date)).toLocaleDateString('fa-IR') }}
                      </time>
                    </p>
                  </div>
                </div>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </AppLayout>
</template>



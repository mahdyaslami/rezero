<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import IconChevronDown from '@/Components/Icons/IconChevronDown.vue'
import IconStar from '@/Components/Icons/IconStar.vue'

defineProps({
  title: {
    type: String,
    required: true
  },
  items: {
    type: Array,
    default: () => [
      {
        name: 'نمونه',
        description: 'این یک نمونه است و حذف نخواهد شد تا بدانم که به چه ویژگی هایی نیاز است.',
        href: '#',
        icon: IconStar
      },
    ]
  }
})

</script>

<template>
  <div>
    <Popover v-slot="{ open }" class="relative">
      <PopoverButton
        class="py-2 px-4"
        :class="[
          open ? 'text-gray-900' : 'text-gray-500',
          'group bg-white rounded-md inline-flex items-center text-base font-medium \
        hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'
        ]"
      >
        <span>{{ title }}</span>
        <IconChevronDown
          :class="[
            open ? 'fill-gray-600' : 'fill-gray-400', 'ltr:ml-2 rtl:mr-2 h-5 w-5 group-hover:fill-gray-500'
          ]"
          aria-hidden="true"
        />
      </PopoverButton>
  
      <transition
        enter-active-class="transition ease-out duration-200"
        enter-from-class="opacity-0 translate-y-1"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition ease-in duration-150"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 translate-y-1"
      >
        <PopoverPanel class="absolute z-10 left-1/2 transform -translate-x-1/2 mt-3 px-2 w-screen max-w-md sm:px-0">
          <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
              <a
                v-for="item in items"
                :key="item.name"
                :href="item.href"
                class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50 transition ease-in-out duration-150"
              >
                <component
                  :is="item.icon"
                  class="flex-shrink-0 h-8 w-8 fill-indigo-600"
                  aria-hidden="true"
                />
                <div class="ltr:ml-4 rtl:mr-4">
                  <p class="text-base font-medium text-gray-900">
                    {{ item.name }}
                  </p>
                  <p class="mt-1 text-sm text-gray-500">
                    {{ item.description }}
                  </p>
                </div>
              </a>
            </div>
          </div>
        </PopoverPanel>
      </transition>
    </Popover>
  </div>
</template>
  
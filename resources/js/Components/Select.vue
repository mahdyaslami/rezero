<script setup>
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import IconCheck from '@/Components/IconCheck.vue'
import IconUnfold from '@/Components/IconUnfold.vue'

defineProps({
    key: {
        type: String,
        default: 'id',
    },
    value: {
        type: String,
        default: 'title'
    },
    label: {
        type: String,
        default: null
    },
    list: {
        type: Array,
        default: () => []
    },
    modelValue: {
        type: Object,
        required: true,
    }
})

const emit = defineEmits(['update:modelValue'])

</script>

<template>
    <Listbox as="div" :modelValue="modelValue" @update:modelValue="$emit('update:modelValue', $event)">
        <ListboxLabel v-show="label !== null" class="block text-sm font-medium text-gray-700">{{ label }}</ListboxLabel>
        <div class="mt-1 relative">
            <ListboxButton
                class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                <span class="block truncate">{{ modelValue[value] }}</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <IconUnfold class="h-5 w-5" fill="gray" aria-hidden="true" />
                </span>
            </ListboxButton>

            <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100"
                leave-to-class="opacity-0">
                <ListboxOptions
                    class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                    <ListboxOption as="template" v-for="item in list" :key="item[key]" :value="item"
                        v-slot="{ active, selected }">
                        <li
                            :class="[active ? 'text-white bg-gray-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-8 pr-4']">
                            <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">
                                {{ item[value] }}
                            </span>

                            <span v-if="selected"
                                :class="[active ? 'text-white' : 'text-gray-600', 'absolute inset-y-0 left-0 flex items-center pl-1.5']">
                                <IconCheck class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </div>
    </Listbox>
</template>
<template>
  <div class="overflow-x-auto">
    <div class="overflow-hidden border border-gray-100 sm:rounded-lg shadow-sm">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <base-th v-show="selectable" />
            <base-th
              v-for="column in head"
              :key="column.key"
            >
              {{ column.title }}
            </base-th>
            <base-th v-show="withEdit || withRemove" />
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(row, rowIndex) in body"
            :key="row[keyColumn]"
            :class="rowIndex % 2 === 0 ? 'bg-white' : 'bg-slate-100'"
          >
            <base-td v-show="selectable">
              <input
                v-model="selected"
                :value="row"
                :type="multiple ? 'checkbox' : 'radio'"
              >
            </base-td>
            <base-td
              v-for="column in head"
              :key="column.key || column.slot"
            >
              <p
                v-if="column.key"
                class="text-gray-900 whitespace-no-wrap"
              >
                {{ prepareValue(column, row) }}
              </p>
              <template v-else-if="column.slot">
                <slot
                  :name="column.slot"
                  :item="row"
                />
              </template>
              <p
                v-else-if="column.computed"
                class="text-gray-900 whitespace-no-wrap"
              >
                {{ column.callback(row) }}
              </p>
              <span v-else>One of 'key' or 'slot' property should exist in head.</span>
            </base-td>
            <base-td
              v-show="withRemove || withEdit"
              class="text-left"
            >
              <button
                v-show="withEdit"
                class="btn-edit"
                @click="fireEdit(row[keyColumn])"
              >
                <icon-pencil class="hover:text-gray-500" />
              </button>
  
              <button
                v-show="withRemove"
                class="btn-remove"
                @click="fireRemove(row[keyColumn])"
              >
                <icon-trash class="hover:text-red-400" />
              </button>
            </base-td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
  
<script setup>
import IconTrash from '@/Components/Icons/IconTrash.vue'
import IconPencil from '@/Components/Icons/IconPencil.vue'
import { computed } from 'vue'
import BaseTd from './Td.vue'
import BaseTh from './Th.vue'
  
const props = defineProps({
  head: {
    type: Array,
    required: true,
  },
  
  body: {
    type: Array,
    required: true,
  },
  
  keyColumn: {
    type: String,
    default: 'id',
  },
  
  selectable: {
    type: Boolean,
    required: false,
    default: false,
  },
  
  multiple: {
    type: Boolean,
    default: false,
  },
  
  modelValue: {
    type: [Array, Object],
    default: null,
  },
  
  withRemove: {
    type: Boolean,
    required: false,
    default: false,
  },
  
  withEdit: {
    type: Boolean,
    required: false,
    default: false,
  },
})
  
const emit = defineEmits(['remove', 'edit', 'select', 'update:modelValue'])
  
const selected = computed({
  get() { 
    return props.multiple ? (props.modelValue ?? []) : props.modelValue
  },
  set(val) { 
    emit('update:modelValue', val) 
  }
})

function fireRemove(key) {
  emit('remove', key)
}
  
function fireEdit(key) {
  emit('edit', key)
}

function prepareValue(column, row) {
  const value = row[column.key]
  return column.callback ? column.callback(value) : value
}
</script>
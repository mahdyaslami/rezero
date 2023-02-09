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
                type="checkbox"
                :checked="isChecked(row[keyColumn])"
                @input="toggle(row[keyColumn])"
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
import IconTrash from '@/Components/IconTrash.vue'
import IconPencil from '@/Components/IconPencil.vue'
import { reactive, watch } from 'vue'
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
  
  multiSelect: {
    type: Boolean,
    default: false,
  },
  
  selected: {
    type: Array,
    default: () => [],
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
  
const emit = defineEmits(['remove', 'edit', 'select'])
  
const state = reactive({
  selectedKeys: [],
})
  
watch(
  () => props.selected,
  () => state.selectedKeys = props.selected.map((el) => el[props.keyColumn]),
  { immediate: true }
)
  
function fireRemove(key) {
  emit('remove', key)
}
  
function fireEdit(key) {
  emit('edit', key)
}
  
function isChecked(id) {
  return state.selectedKeys.includes(id)
}
  
function prepareValue(column, row) {
  const value = row[column.key]
  return column.callback ? column.callback(value) : value
}
  
function toggle(id) {
  if (props.multiSelect) {
    toggleMultiple(id)
    fireSelect(state.selectedKeys)
  } else {
    toggleSingle(id)
    fireSelect(state.selectedKeys[0])
  }
}
  
function toggleMultiple(id) {
  const index = state.selectedKeys.indexOf(id)
  
  if (index < 0) {
    state.selectedKeys.push(id)
  } else {
    state.selectedKeys.splice(index, 1)
  }
}
  
function toggleSingle(id) {
  if (state.selectedKeys[0] === id) {
    state.selectedKeys = []
  } else {
    state.selectedKeys[0] = id
  }
}
  
function fireSelect(ev) {
  emit('select', ev)
}
</script>
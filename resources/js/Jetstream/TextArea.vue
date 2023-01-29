<script setup>
import { onMounted, ref } from 'vue'

defineProps({
  modelValue: String,
})

defineEmits(['update:modelValue'])

const textarea = ref(null)

onMounted(() => {
  if (textarea.value.hasAttribute('autofocus')) {
    textarea.value.focus()
  }
})

defineExpose({ focus: () => textarea.value.focus() })
</script>

<template>
  <textarea 
    ref="textarea"
    class="block w-full py-3 border-0 resize-none focus:ring-0 sm:text-sm"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  >
        <slot />
    </textarea>
</template>

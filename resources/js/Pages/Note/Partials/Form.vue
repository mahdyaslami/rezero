<script setup>
import { useForm } from '@inertiajs/vue3'
import JetTextArea from '@/Components/Base/TextArea.vue'
import JetInputError from '@/Components/Base/InputError.vue'
import JetActionMessage from '@/Components/ActionMessage.vue'
import JetButton from '@/Components/Base/Button.vue'

const props = defineProps({
  notes: {
    type: Object,
    require: true
  }
})

const form = useForm({
  content: '',
})

function save() {
  form.post(route('notes.store'))
}

</script>

<template>
  <div class="flex items-start space-x-4">
    <div class="min-w-0 flex-1">
      <form class="relative" @submit.prevent="save">
        <div
          class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-gray-500 focus-within:ring-1 focus-within:ring-gray-500"
        >
          <JetTextArea
            id="comment"
            v-model="form.content"
            rows="10"
            name="comment"
            placeholder="یادداشتت رو اینجا بنویس"
          />


          <div class="pr-3 pl-2 py-2 flex justify-end bg-gray-50" aria-hidden="true">
            <JetInputError :message="form.errors.content" class="mt-2" />

            <JetActionMessage :on="form.recentlySuccessful" class="ltr:mr-3 rtl:ml-3">
              ذخیره شد
            </JetActionMessage>

            <JetButton type="submit">
              ذخیره
            </JetButton>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

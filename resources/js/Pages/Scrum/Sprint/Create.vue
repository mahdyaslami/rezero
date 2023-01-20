
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AppSelect from '@/Components/Select.vue'
import { ref } from 'vue';

const props = defineProps({
    repos: {
        type: Array,
        required: true
    }
})

const selected = ref(props.repos[0])
</script>

<template>
    <AppLayout title="New Sprint">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <AppSelect value="name" :list="repos" v-model="selected" />
        </div>
    </AppLayout>
</template>



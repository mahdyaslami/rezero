
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AppSelect from '@/Components/Select.vue'
import { ref } from 'vue';

const people = [
    { id: 1, name: 'Wade Cooper' },
    { id: 2, name: 'Arlene Mccoy' },
    { id: 3, name: 'Devon Webb' },
    { id: 4, name: 'Tom Cook' },
    { id: 5, name: 'Tanya Fox' },
    { id: 6, name: 'Hellen Schmidt' },
    { id: 7, name: 'Caroline Schultz' },
    { id: 8, name: 'Mason Heaney' },
    { id: 9, name: 'Claudie Smitham' },
    { id: 10, name: 'Emil Schaefer' },
]

const selected = ref(people[3])
</script>

<template>
    <AppLayout title="New Sprint">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <AppSelect value="name" :list="people" v-model="selected" />
        </div>
    </AppLayout>
</template>



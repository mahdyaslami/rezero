<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import ApplicationLogo from '@/Jetstream/ApplicationLogo.vue';
</script>

<template>
    <Link :href="'/'">
        <application-logo class="w-20" />
    </Link>
</template>

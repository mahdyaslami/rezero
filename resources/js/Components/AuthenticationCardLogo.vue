<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
</script>

<template>
  <a :href="route('welcome')">
    <application-logo class="w-20" />
  </a>
</template>

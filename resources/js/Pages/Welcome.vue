<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen 
        bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 
            px-6 py-4 sm:block w-full text-end">
            <a v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 underline">
                میزکار
            </a>

            <template v-else>
                <a :href="route('login')" class="text-sm text-gray-700 underline">
                    ورود
                </a>

                <a v-if="canRegister" :href="route('register')" class="ltr:ml-4 rtl:mr-4 text-sm text-gray-700 underline">
                    ثبت نام
                </a>
            </template>
        </div>

        <div>
            <img src="/logo-1.png" alt="logo">
        </div>
    </div>
</template>


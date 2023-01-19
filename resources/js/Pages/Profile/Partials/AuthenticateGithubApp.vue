<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import JetActionSection from '@/Jetstream/ActionSection.vue';
import JetButton from '@/Jetstream/Button.vue';

const form = useForm({});

const confirmInGithub = () => {
    document.location = route('github.redirect')
};
</script>

<template>
    <JetActionSection>
        <template #title>
            تایید اعتبار برنامه در Github
        </template>

        <template #description>
            تایید اعتبار برنامه در Github
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                شما می تواند برای استفاده از برنامه Scrum این برنامه را در Github نصب و تایید اعتبار کنید.
            </div>

            <div class="mt-5">
                <JetButton @click="confirmInGithub">
                    تایید اعتبار برنامه در Github
                </JetButton>
            </div>
        </template>
    </JetActionSection>
</template>

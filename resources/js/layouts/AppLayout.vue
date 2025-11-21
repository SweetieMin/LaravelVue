<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import 'vue-sonner/style.css'
import { Toaster } from '@/components/ui/sonner'
import { nextTick, watch } from 'vue';
import { toast } from 'vue-sonner';
import { usePage } from '@inertiajs/vue3';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage();

watch(
    () => page.props.flash,
    async (flash) => {
        if (!flash) return;

        await nextTick(); 

        if (flash.success) {
            toast.success(flash.success);
            flash.success = null;
        }

        if (flash.error) {
            toast.error(flash.error);
            flash.error = null;
        }

        if (flash.warning) {
            toast.warning(flash.warning);
            flash.warning = null;
        }

        if (flash.info) {
            toast.info(flash.info);
            flash.info = null;
        }
    },
    { immediate: true },
);

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
        <Toaster position="top-right" rich-colors close-button />
    </AppLayout>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';


import management from '@/routes/management';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Quản lý sự kiện',
        href: management.events.index().url,
    },
];


</script>

<template>
    <Head title="Quản lý sự kiện" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <Link :href="management.events.create().url">
                <Button> Thêm sự kiện </Button>
            </Link>
            
        </div>
    </AppLayout>
</template>

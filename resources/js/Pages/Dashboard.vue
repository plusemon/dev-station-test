<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="card">
            <div class="card-body">
                <h4>You're logged in!</h4>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
    auth: Object
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="card">
            <div class="card-body">
                <h2>Welcome ({{ auth.user.name }})</h2>
                <h4>You're logged in!</h4>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

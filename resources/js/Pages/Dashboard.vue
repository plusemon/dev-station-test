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

        <div class="alert alert-info mt-3">
            If you are just logged in please refresh once! it will fix the styling issue
            <!-- reson: When login success Guest layout assets still remain in Authenticated layout-->
            <!-- I couldnot found any solution to fix this problem. it maybe innertia bugs -->
        </div>
    </AuthenticatedLayout>
</template>

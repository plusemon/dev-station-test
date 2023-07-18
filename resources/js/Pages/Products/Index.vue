<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

const props = defineProps({
    products: Object
})

</script>

<template>
    <Head title="Products" />

    <AuthenticatedLayout>

        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-3 card-header">
                <div class="h5">Products</div>
                <Link class="btn btn-primary" :href="route('products.create')">New Product</Link>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products">
                            <td>{{ product.id }}</td>
                            <td>{{ product.title }}</td>
                            <td>{{ product.price }} tk</td>
                            <td>
                                <!-- Edit | Delete -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

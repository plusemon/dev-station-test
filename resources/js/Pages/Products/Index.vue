<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { useToast } from "vue-toastification"

const props = defineProps({
    products: Object
})

const deleteForm = useForm({
    id: null
})

const toast = useToast()

const deleteProduct = ({ id }) => {
    if (confirm('Are you sure want to delete?')) {
        deleteForm.id = id
        deleteForm.delete(route('products.destroy', id), {
            onSuccess: () => {
                deleteForm.reset()
                toast.warning("Product has been deleted successfully")
            },
            onError: (err) => console.log(err)
        })
    }
}

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
                <table  v-if="products.length" class="table table-bordered">
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
                                <button @click="deleteProduct(product)" class="btn btn-danger"> Delete </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 v-else class="text-center h6">No Items Found</h3>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import { reactive } from 'vue'

defineProps({
    errors: Object
})

const form = useForm({
    title: '',
    price: '',
})

const status = ref(false)

const productFormSubmitHandler = () => {
    form.post(route('products.store'), {
        onSuccess: () => {
            form.reset()
            status.value = "Product has been added successfully"
        },
    })
}

</script>

<template>
    <Head title="Create Product" />

    <AuthenticatedLayout>

        <div v-if="status" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ status }}
        </div>

        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-3 card-header">
                <div class="h5">Products</div>
                <Link :href="route('products.index')" class="btn btn-outline-secondary">Back to list</Link>

            </div>
            <div class="card-body">
                <form @submit.prevent="productFormSubmitHandler">

                    <div class="mb-2">
                        <label for="title">Title</label>
                        <input type="text" v-model="form.title" placeholder="Ex: Lux Shop"
                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                        <div class="text-danger fw-bold " v-if="errors.title">{{ errors.title }}</div>
                    </div>

                    <div class="mb-2">
                        <label for="price">Price (Tk)</label>
                        <input type="number" v-model="form.price" placeholder="Ex: 80"
                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                        <div class="text-danger fw-bold " v-if="errors.price">{{ errors.price }}</div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary bg-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

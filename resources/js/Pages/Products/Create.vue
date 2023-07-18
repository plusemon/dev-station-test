<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
    title: '',
    price: '',
})

const productFormSubmitHandler = () => {
    form.post(route('products.store'), {
        onFinish: () => alert('Product has been saved'),
    })
}
</script>

<template>
    <Head title="Create Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Product</h2>
        </template>

        <!-- component -->
        <div class="p-6 bg-gray-100 flex items-center justify-center">
            <div class="container max-w-screen-lg mx-auto">
                <form @submit.prevent="productFormSubmitHandler">
                    <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">

                            <div class="md:col-span-5">
                                <label for="title">Product Title</label>
                                <input type="text" v-model="form.title"
                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                            </div>

                            <div class="md:col-span-5">
                                <label for="price">Product Price</label>
                                <input type="number" v-model="form.price"
                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                            </div>


                            <div class="md:col-span-5 text-right">
                                <br>
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save
                                    Product</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </AuthenticatedLayout>
</template>

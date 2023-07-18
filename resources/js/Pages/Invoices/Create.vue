<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { computed } from 'vue'
import { ref } from 'vue'

const props = defineProps(['nextInvoiceId', 'products'])
const status = ref(false)

const form = useForm({
    invoiceDate: new Date().toJSON().slice(0, 10),
    dueDate: '',
    customer_email: '',

    items: [
        {
            uid: 1,
            product_id: '',
            unit_price: 0,
            qty: 1,
        }
    ],
    discount: 0,
    tax: 0,
    note: ''
})

const itemsUid = ref(1)

const addNewInvoiceItem = () => {
    form.items.push({
        uid: ++itemsUid.value,
        product_id: '',
        unit_price: 0,
        qty: 1,
    })
}
const removeInvoiceItem = (uid) => {
    if (form.items.length !== 1) {
        form.items = form.items.filter(item => item.uid != uid)
    }
}

const subTotalAmount = computed(() => {
    return form.items.map(item => item.unit_price * item.qty).reduce((previousValue, currentValue) => {
        return previousValue + currentValue
    }, 0)
})

const totalAmount = computed(() => {
    return subTotalAmount.value - form.discount + form.tax
})

const formSubmitHandler = () => {
    form.post(route('invoices.store'), {
        onSuccess: () => {
            form.reset()
            status.value = "Invoices has been saved successfully"
        }
    })
}


</script>

<template>
    <Head title="New Invoices" />

    <AuthenticatedLayout>
        <div v-if="status" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ status }}
        </div>

        <div class="card">

            <div class="card-body">
                <form @submit.prevent="formSubmitHandler">

                    <!-- header -->
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="h1">Logo</h1>
                        </div>
                        <div class="col-md-4 text-end">
                            <p> Invoice #{{ nextInvoiceId }}</p>
                            <div class="d-flex align-items-center gap-1">
                                <p>Date</p>
                                <input type="date" v-model="form.invoiceDate" class="form-control" required>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <p>Due date</p>
                                <input type="date" v-model="form.dueDate" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <b>Billed From</b>
                            <p>Jane Doe</p>
                            <p>206 Yonge St, Toranto - M4S 2A3</p>
                            <p>Tel: 11223344</p>
                            <p>info@google.com</p>
                        </div>
                        <div class="col-md-6">
                            <b>Billed To</b>
                            <p>Jane Doe</p>
                            <p>206 Yonge St, Toranto - M4S 2A3</p>
                            <p>Tel: 11223344</p>
                            <input type="email" v-model="form.customer_email" placeholder="customer email"
                                    class="form-control" required>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in form.items" :key="item.uid">
                                <td>
                                    <select class="form-control" v-model="item.product_id" required>
                                        <option value="">Select A Product</option>
                                        <option v-for="product in products" :value="product.id">{{ product.title }}</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" placeholder="enter price" v-model="item.unit_price" required>
                                </td>
                                <td>
                                    <input type="number" placeholder="enter qty" v-model="item.qty" required>
                                </td>
                                <td>{{ item.unit_price * item.qty }} tk</td>
                                <td><button type="button" @click="removeInvoiceItem(item.uid)"
                                        class="btn fw-bold">X</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" @click="addNewInvoiceItem" class="btn border">+ New Item</button>

                    <div class="d-flex justify-content-between align-items-start mt-3 mb-3">

                        <div class="col-md-8">
                            <textarea rows="4" class="form-control" v-model="form.note"
                                placeholder="enter comment/note"></textarea>
                        </div>

                        <div class="col-md-4">
                            <table class="table table-bordered text-end">
                                <tr>
                                    <th class="text-e">Subtotal: </th>
                                    <td>{{ subTotalAmount }} tk</td>
                                </tr>
                                <tr>
                                    <th class="text-e">Discount: </th>
                                    <td>0 tk</td>
                                </tr>
                                <tr>
                                    <th class="text-e">Tax: </th>
                                    <td>0 tk</td>
                                </tr>
                                <tr>
                                    <th class="text-e">Total: </th>
                                    <td>{{ totalAmount }} tk</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary bg-primary" type="submit">Save Invoice</button>
                    </div>
                </form>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

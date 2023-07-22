<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, router } from '@inertiajs/vue3'
import SpinnerBtn from '@/Components/SpinnerBtn.vue'
import { useToast } from 'vue-toastification'
import { computed } from 'vue'
import { ref } from 'vue'

//------------- recieved props. from the controller ------------------//
const props = defineProps({
    errors: Object,
    nextInvoiceId: Number,
    products: Object,
    auth: Object
})

//------------- data properties ------------------//
const toast = useToast()
const dueDate = new Date()
dueDate.setDate(dueDate.getDate() + 7)
const itemsUid = ref(1)

const form = useForm({
    invoiceDate: new Date().toJSON().slice(0, 10),
    dueDate: dueDate.toJSON().slice(0, 10),
    customer_email: props?.auth?.user?.email ?? '',

    items: [
        {
            uid: 1,
            product_id: '',
            unit_price: 0,
            qty: 0
        }
    ],
    discount: 0,
    tax: 0,
    note: ''
})

//------------- computed properties ------------------//
const subTotalAmount = computed(() => {
    return form.items
        .map(item => item.unit_price * item.qty)
        .reduce((previousValue, currentValue) => {
            return previousValue + currentValue
        }, 0)
})

const totalAmount = computed(() => {
    return subTotalAmount.value - form.discount + form.tax
})

//------------- methods ------------------//
const addNewInvoiceItem = () => {
    form.items.push({
        uid: ++itemsUid.value,
        product_id: '',
        unit_price: 0,
        qty: 0
    })
}

const checkInItemsAndSetProductPrice = selectedItem => {
    let itemFound = form.items.filter(
        item => item.product_id == selectedItem.product_id
    ).length
    if (itemFound > 1) {
        toast.warning('Product already exists, please choose another product')
        selectedItem.product_id = ''
    } else {
        let product = props.products.find(p => p.id == selectedItem.product_id)
        if (product) {
            selectedItem.unit_price = product.price ?? 0
            selectedItem.qty = 1
        } else {
            selectedItem.unit_price = 0
            selectedItem.qty = 0
        }
    }
}

const removeInvoiceItem = uid => {
    if (form.items.length !== 1) {
        form.items = form.items.filter(item => item.uid != uid)
    }
}

const formSubmitHandler = () => {
    form.post(route('invoices.store'), {
        onSuccess: () => {
            form.reset()
            toast.success('Invoices has been saved successfully')
        }
    })
}

const goBackConfirmation = () => {
    let decision = confirm(
        'Are you sure want to leave this page? warning: all changes will be lost!'
    )
    if (decision) return router.replace(route('invoices.index'))
}
</script>

<template>
    <Head title="New Invoices" />

    <AuthenticatedLayout>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="formSubmitHandler">
                    <!-- header -->
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="h1">Logo</h1>
                        </div>
                        <div class="col-md-4 text-end">
                            <p class="h2 mb-3">Invoice #{{ nextInvoiceId }}</p>
                            <div class="row align-items-center mb-2">
                                <div class="col-md-4">Invoice Date</div>
                                <div class="col-md-8">
                                    <input type="date" v-model="form.invoiceDate" class="form-control" required />
                                    <div class="text-danger fw-bold" v-if="form.errors.invoiceDate">
                                        {{ form.errors.invoiceDate }}
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-4">Due date</div>
                                <div class="col-md-8">
                                    <input type="date" v-model="form.dueDate" class="form-control" required />
                                    <div class="text-danger fw-bold" v-if="form.errors.dueDate">
                                        {{ form.errors.dueDate }}
                                    </div>
                                </div>
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
                            <div class="row align-items-center">
                                <div class="col-md-4">Customer Email</div>
                                <div class="col-md-8">
                                    <input type="email" v-model="form.customer_email" placeholder="customer email"
                                        class="form-control" required />
                                    <i class="small text-info">info: a copy of invoice will be sent to
                                        this email</i>
                                </div>
                                <div class="text-danger fw-bold" v-if="form.errors.customer_email">
                                    {{ form.errors.customer_email }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" @click="addNewInvoiceItem" class="btn btn-outline-dark mb-2">
                        + Add New Item
                    </button>
                    <table class="table table-hover border">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in form.items" :key="item.uid">
                                <td class="text-center">
                                    <button type="button" @click="removeInvoiceItem(item.uid)"
                                        class="btn btn-outline-danger">
                                        X
                                    </button>
                                </td>
                                <td>
                                    <select class="form-control" v-model="item.product_id" @change="
                                        checkInItemsAndSetProductPrice(item)
                                        " required>
                                        <option value="">
                                            Select A Product
                                        </option>
                                        <option v-for="product in products" :value="product.id">
                                            {{
                                                `ID:${product.id} -
                                                                                        ${product.title} (${product.price} tk)`
                                            }}
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control" :disabled="!item.product_id"
                                        placeholder="enter price" v-model="item.unit_price" required />
                                </td>
                                <td>
                                    <input type="number" class="form-control" :disabled="!item.product_id"
                                        placeholder="enter qty" min="1" v-model="item.qty" required />
                                </td>
                                <td class="text-end">
                                    {{ item.unit_price * item.qty }} tk
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-start mt-3 mb-3">
                        <div class="col-md-8">
                            <textarea rows="4" class="form-control" v-model="form.note"
                                placeholder="enter comment/note"></textarea>
                            <div class="text-danger fw-bold" v-if="form.errors.note">
                                {{ form.errors.note }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <table class="table table-hover text-end">
                                <tbody>
                                    <tr>
                                        <th class="text-e">Subtotal:</th>
                                        <td>{{ subTotalAmount }} tk</td>
                                    </tr>
                                    <tr>
                                        <th class="text-e">Discount:</th>
                                        <td>
                                            <div class="d-flex justify-content-end gap-1 align-items-center">
                                                <input type="number" class="form-control w-25 text-end" min="0"
                                                    v-model="form.discount" :disabled="!subTotalAmount" />
                                                <span>tk</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-e">Tax:</th>
                                        <td>0 tk</td>
                                    </tr>
                                    <tr class="table-active">
                                        <th class="text-e">Total:</th>
                                        <td>{{ totalAmount }} tk</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex gap-5 mb-5 border-bottom border-2 pb-5 justify-content-center">
                        <button type="button" @click="goBackConfirmation" class="btn btn-secondary">
                            Back to list
                        </button>
                        <SpinnerBtn :processing="form.processing" classes="btn-success" btn-text="Save Invoice" />
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

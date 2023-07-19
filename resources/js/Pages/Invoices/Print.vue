<script setup>
import { onMounted } from 'vue'

const props = defineProps({
    invoice: Object
})

onMounted(() => {
    // window.print()
})

</script>

<template>
    <!-- <AuthenticatedLayout> -->

    <main class="m-1 bg-white">
        <div class="invoice p-3 mt-3">
            <div class="row">
                <div class="mb-4 col-7">
                    <div class="app-brand-logo demo">
                        <h1 class="h2">Logo</h1>
                    </div>
                </div>
                <div class="col-5 text-end mt-3">
                    <h3>Invoice #{{ invoice.id }}</h3>
                    <p><strong>Date:</strong> {{ invoice.invoice_date }}</p>
                    <p><strong>Due Date:</strong> {{ invoice.due_date }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between mb-4">
                <div>
                    <b>Billed From:</b>
                    <p class="my-0">Jane Doe</p>
                    <p class="my-0">206 Yonge St, Toranto - M4S 2A3</p>
                    <p class="my-0"><strong>Tel:</strong> 11223344</p>
                    <p class="my-0"><strong>Email</strong> admin@devstation.com</p>
                </div>
                <div>
                    <b>Billed To:</b>
                    <p class="my-0">Jane Doe</p>
                    <p class="my-0">206 Yonge St, Toranto - M4S 2A3</p>
                    <p class="my-0"><strong>Tel:</strong> 11223344</p>
                    <p class="my-0"><strong>Email:</strong> {{ invoice.customer_email }}</p>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr class="fw-bold">
                        <th>#</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in invoice.invoice_items">
                        <td>{{ item.id }}</td>
                        <td>{{ item.product.title }}</td>
                        <td>{{ item.qty }} pcs</td>
                        <td>{{ item.unit_price }} tk</td>
                        <td>{{ item.total_amount }} tk</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="fw-bold">
                        <td></td>
                        <td>Total</td>
                        <td>{{ invoice.total_qty }} pcs</td>
                        <td></td>
                        <td>{{ invoice.total_amount }} pcs</td>
                    </tr>
                </tfoot>
            </table>
            <p style="margin-top: 80px;">Thanks for for your review :)</p>
        </div>
    </main>

    <!-- </AuthenticatedLayout> -->
</template>

<style>
@import url('https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css');
</style>
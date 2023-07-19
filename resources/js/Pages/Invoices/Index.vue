<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

const props = defineProps({
    invoices: Object
})

const deleteForm = useForm({
    id: null
})


const deleteInvoice = ({ id }) => {
    if (confirm('Are you sure want to delete?')) {
        deleteForm.id = id
        deleteForm.delete(route('invoices.destroy', id), {
            onSuccess: () => {
                deleteForm.reset()
                toast.warning("Invoice has been deleted successfully")
            },
            onError: (err) => console.log(err)
        })
    }
}

</script>

<template>
    <Head title="Invoices" />

    <AuthenticatedLayout>
        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-3 card-header">
                <div class="h5">Invoices</div>
                <Link class="btn btn-primary" :href="route('invoices.create')">New Invoice</Link>
            </div>
            <div class="card-body">
                <table v-if="invoices?.length" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Email</th>
                            <th>Total Amount</th>
                            <th>Subtotal Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="invoice in invoices">
                            <td>#{{ invoice.id }}</td>
                            <td>{{ invoice.customer_email }}</td>
                            <td>{{ invoice.total_amount }}</td>
                            <td>{{ invoice.sub_total_amount }}</td>
                            <td>
                                <button @click="deleteInvoice(invoice)" class="btn btn-danger"> Delete </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                 <h3 v-else class="text-center h6">No Items Found</h3>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import NavLink from '@/Components/NavLink.vue'
import { Link } from '@inertiajs/vue3'
import DropdownLink from '@/Components/DropdownLink.vue'
import 'bootstrap/dist/css/bootstrap.min.css'

</script>

<template>
    <div>
        <div class="bg-secondary-subtle py-3 mb-4 border-bottom">
            <header class="container d-flex flex-wrap justify-content-center">
                <Link :href="route('dashboard')"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">DevStation</span>
                </Link>

                <ul class="nav nav-pills me-5 align-items-center">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </NavLink>
                    <NavLink :href="route('products.index')" :active="route().current('products.index')">
                        Products
                    </NavLink>
                    <NavLink :href="route('invoices.index')" :active="route().current('invoices.index')">
                        Invoices
                    </NavLink>
                    <DropdownLink :href="route('logout')" method="post" as="button" class="ms-5 btn btn-outline-dark">Logout</DropdownLink>
                </ul>

            </header>
        </div>
        <!-- Page Heading -->
        <header v-if="$slots.header">
            <slot name="header" />
        </header>

        <!-- Page Content -->
        <main class="container">
            <slot />
        </main>
    </div>
</template>

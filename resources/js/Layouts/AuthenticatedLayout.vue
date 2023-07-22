<script setup>
import NavLink from '@/Components/NavLink.vue'
import { Link } from '@inertiajs/vue3'

</script>

<template>
    <div>
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <Link :href="route('dashboard')"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Simple header</span>
                </Link>

                <ul class="nav nav-pills">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </NavLink>
                    <NavLink :href="route('products.index')" :active="route().current('products.index')">
                        Products
                    </NavLink>
                    <NavLink :href="route('invoices.index')" :active="route().current('invoices.index')">
                        Invoices
                    </NavLink>
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

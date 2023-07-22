<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
})

const classes = computed(() =>
    props.active
        ? 'nav-link border-bottom border-2 border-black rounded-1 bg-body-secondary text-black'
        : 'nav-link text-black'
)
</script>

<template>
    <li class="nav-item">
        <Link :href="href" :class="classes" :aria-current="props.active ? 'page' : ''">
        <slot />
        </Link>
    </li>
</template>

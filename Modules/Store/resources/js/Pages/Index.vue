<template>
    <div>
        <ProductGrid title="Raket" />
        <ProductGrid title="Sepatu" />
        <ProductGrid title="Tas" />
        <ProductGrid title="Apparel"/>
    </div>

</template>

<script setup>
import StoreLayout from '../Layouts/StoreLayout.vue'
import ProductGrid from '../components/layout/ProductGrid.vue';
import { route } from 'ziggy-js';


defineOptions({
    layout: (h, page) =>
        h(StoreLayout, {}, {
            default: () => page,
        }),
})

</script>

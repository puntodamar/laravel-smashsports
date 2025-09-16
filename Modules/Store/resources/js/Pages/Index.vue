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



defineOptions({
    layout: (h, page) =>
        h(StoreLayout, {title: "Toko"}, {
            default: () => page,
        }),
})

</script>

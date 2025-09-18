<template>
    <div>
        <ProductGrid title="Raket" :icon="IconRacket" />
        <ProductGrid title="Sepatu" :icon="IconShoe"  />
        <ProductGrid title="Tas"  :icon="IconBag" />
        <ProductGrid title="Apparel" :icon="IconShirt" />
        <ProductGrid title="Shuttlecocks" :icon="IconShuttlecock" />
    </div>

</template>

<script setup>
import StoreLayout from '../Layouts/StoreLayout.vue'
import ProductGrid from '../components/layout/ProductGrid.vue';
import { IconRacket, IconShoe, IconShirt, IconShuttlecock, IconBag} from '@js/icons.js';


defineOptions({
    layout: (h, page) =>
        h(StoreLayout, {title: "Toko"}, {
            default: () => page,
        }),
})

</script>

<template>
    <div>
        <ProductGrid v-if="props.raket.length > 0" title="Raket" :icon="IconRacket" :items="props.raket" :showMore="showMore && props.raket.length > 4" />
        <ProductGrid v-if="props.sepatu.length > 0" title="Sepatu" :icon="IconShoe" :items="props.sepatu" :showMore="showMore && props.sepatu.length > 4"  />
        <ProductGrid v-if="props.tas.length > 0" title="Tas"  :icon="IconBag" :items="props.tas" :showMore="showMore && props.tas.length > 4" />
        <ProductGrid v-if="props.apparel.length > 0" title="Apparel" :icon="IconShirt" :items="props.apparel"  :showMore="showMore && props.apparel.length > 4"/>
        <ProductGrid v-if="props.shuttlecocks.length > 0" title="Shuttlecocks" :icon="IconShuttlecock" :items="props.shuttlecocks" :showMore="showMore && props.shuttlecocks.length > 4" />
    </div>

</template>

<script setup>
import StoreLayout from '../Layouts/StoreLayout.vue'
import ProductGrid from '../components/layout/ProductGrid.vue';
import { IconRacket, IconShoe, IconShirt, IconShuttlecock, IconBag} from '@js/icons.js';

const props = defineProps({
    raket: {type: Array, default: () => []},
    sepatu: {type: Array, default: () => []},
    tas: {type: Array, default: () => []},
    apparel: {type: Array, default: () => []},
    shuttlecocks: {type: Array, default: () => []},
    showMore: {type: Boolean, default: true},
})



defineOptions({
    layout: (h, page) =>
        h(StoreLayout, {title: "Toko"}, {
            default: () => page,
        }),
})

</script>

<template>
    <div>

    <StoreHeaderMobile />

    <StoreHeaderDesktop
        :rotator-text="rotatorText"
        :app-name="props.appName"
    />

    </div>
</template>

<script setup>
import { inject, ref, provide, defineProps } from 'vue';
import { route } from 'ziggy-js';
import StoreHeaderMobile from './StoreHeaderMobile.vue';
import StoreHeaderDesktop from './StoreHeaderDesktop.vue';
import {useTokoStore} from '@store/js/stores/toko_store.js';


const tokoStore = useTokoStore();
tokoStore.setCompanyLogo(inject('companyLogo'));

const props = defineProps({
    appName: String,
})

const open = ref(false); provide('open', open);

const rotatorText = [
    `Dapatkan harga khusus dengan menjadi <a href="#" class="underline text-gold dark:brightness-80" data-inertia>member!</a>`,
    `Para sultan merapat! Nanoflare 1000ZZ bisa dibeli <a href="${route('store.product.detail', { product_type: 'raket', sub_product: 'yonex', product: 'yonex-1000-z' })}" class="text-gold underline" data-inertia>di sini</a>.`,
    `Cobain deh, menu baru spesial: <span class="text-gold">Ayam Katsu Blackpepper</span>`,
]


</script>

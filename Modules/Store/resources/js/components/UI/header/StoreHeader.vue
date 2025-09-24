<template>
    <div>

    <StoreHeaderMobile :navigation="navigation" :auth-user="authUser"  />

    <StoreHeaderDesktop
        :rotator-text="rotatorText"
        :company-logo="companyLogo"
        :app-name="props.appName"
        :navigation="navigation"
        :auth-user="authUser"
    />

    </div>
</template>

<script setup>
import { inject, ref, provide, defineProps, computed } from 'vue';

import { route } from 'ziggy-js';

import { IconBag, IconRacket, IconShoe, IconShirt, IconShuttlecock } from '@js/icons.js';
import StoreHeaderMobile from './StoreHeaderMobile.vue';
import StoreHeaderDesktop from './StoreHeaderDesktop.vue';
import { PencilSquareIcon, BuildingStorefrontIcon } from '@heroicons/vue/24/outline'
import { usePage } from '@inertiajs/vue3';
const page = usePage()
const authUser = computed(() => page.props?.auth?.user)
console.log(authUser)
const companyLogo = inject('companyLogo')
const props = defineProps({
    appName: String,
})

const open = ref(false); provide('open', open);



const rotatorText = [
    `Dapatkan harga khusus dengan menjadi <a href="#" class="underline text-gold dark:brightness-80" data-inertia>member!</a>`,
    `Para sultan merapat! Nanoflare 1000ZZ bisa dibeli <a href="${route('store.product.detail', { product_type: 'raket', product: 'test' })}" class="text-gold underline" data-inertia>di sini</a>.`,
    `Cobain deh, menu baru spesial: <span class="text-gold">Ayam Katsu Blackpepper</span>`,
]

const navigation = {
    categories: [
        {
            name: 'Raket',
            icon: IconRacket,
            collection: [
                { name: 'Terbaru', href: '#' },
                { name: 'Diskon', href: '#' },
                { name: 'Sale', href: '#' },
            ],
            categories: [
                { name: 'Paket Hemat', href: '#' },
                { name: 'Tebus Murah', href: '#' },
                { name: 'Pro Series', href: '#' },
            ],
            brands: [
                { name: 'Yonex', href: '#' },
                { name: 'Lining', href: '#' },
                { name: 'Victor', href: '#' },
            ],
        },
        {
            name: 'Sepatu',
            icon: IconShoe,
            collection: [
                { name: 'Terbaru', href: '#' },
                { name: 'Diskon', href: '#' },
            ],
            brands: [
                { name: 'Yonex', href: '#' },
                { name: 'Lining', href: '#' },
                { name: 'Victor', href: '#' },
            ],
        },

        {
            name: 'Tas',
            icon: IconBag,
            collection: [
                { name: 'Terbaru', href: '#' },
                { name: 'Diskon', href: '#' },
            ],
            brands: [
                { name: 'Yonex', href: '#' },
                { name: 'Lining', href: '#' },
                { name: 'Victor', href: '#' },
            ],
        },

        { name: "Apparel", icon: IconShirt },
        {
            name: "Shuttlecocks",
            icon: IconShuttlecock,
            brands: [
                { name: 'Yonex', href: '#' },
                { name: 'Lining', href: '#' },
                { name: 'Victor', href: '#' },
            ],
        },

    ],
    pages: [
        { name: 'Booking', href: route('schedule.booking'), icon: PencilSquareIcon },
        { name: 'Resto', href: '#', icon: BuildingStorefrontIcon },
    ],
}


</script>

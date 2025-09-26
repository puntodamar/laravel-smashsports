import { defineStore } from 'pinia';
import { route } from 'ziggy-js';
import { BuildingStorefrontIcon, PencilSquareIcon } from '@heroicons/vue/24/outline/index.js';
import { IconBag, IconRacket, IconShirt, IconShoe, IconShuttlecock } from '@/icons.js';
import { markRaw } from 'vue';

export const useTokoStore = defineStore('toko', {
    state: () => ({
        cart: [],
        navigation: {
            categories: [
                {
                    name: 'Raket',
                    icon: markRaw(IconRacket),
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
                    icon: markRaw(IconShoe),
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
                    icon: markRaw(IconBag),
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

                { name: "Apparel", icon: markRaw(IconShirt) },
                {
                    name: "Shuttlecocks",
                    icon: markRaw(IconShuttlecock),
                    brands: [
                        { name: 'Yonex', href: '#' },
                        { name: 'Lining', href: '#' },
                        { name: 'Victor', href: '#' },
                    ],
                },

            ],
            pages: [
                { name: 'Booking', href: route('schedule.booking'), icon: markRaw(PencilSquareIcon), },
                { name: 'Resto', href: '#', icon: markRaw(BuildingStorefrontIcon) },
            ],
        },
        companyLogo: null,
        comparison: []

    }),
    getters: {
        cartItems () {
            return this.cart
        },
        totalItems() {
            return this.cart.reduce((n, i) => n + (Number(i.amount) || 0), 0)
        },
        getComparisonItems () {
          return this.comparison
        },
        getCompanyLogo () {
            return this.companyLogo
        }
    },
    actions: {
        addToCart(item) {
            this.cart.push(item);
        },
        addToComparison(item) {
            this.comparison.push(item)
        },
        clear() {
            this.cart = [];
        },
        setCompanyLogo (companyLogo) {
            this.companyLogo = companyLogo;
        }
    },
});

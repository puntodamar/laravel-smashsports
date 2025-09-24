import { defineStore } from 'pinia';
import { route } from 'ziggy-js';
import { BuildingStorefrontIcon, PencilSquareIcon } from '@heroicons/vue/24/outline/index.js';
import { IconBag, IconRacket, IconShirt, IconShoe, IconShuttlecock } from '@/icons.js';

export const useTokoStore = defineStore('toko', {
    state: () => ({
        cart: [],
        navigation: {
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
        },
        companyLogo: null

    }),
    getters: {
        cartItems () {
            return this.cart
        },
        getCompanyLogo () {
            return this.companyLogo
        }
    },
    actions: {
        addToCart(item) {
            this.cart.push(item);
        },
        clear() {
            this.cart = [];
        },
        setCompanyLogo (companyLogo) {
            this.companyLogo = companyLogo;
        }
    },
});

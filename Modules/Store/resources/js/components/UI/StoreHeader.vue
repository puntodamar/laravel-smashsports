<template>
    <div>
        <!-- Mobile menu -->
        <TransitionRoot as="template" :show="open">
            <Dialog class="relative z-40 lg:hidden" @close="open = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="" leave="transition-opacity ease-linear duration-300" leave-from="" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black/25" />
                </TransitionChild>
                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                        <DialogPanel class="relative flex w-full max-w-xs flex-col overflow-y-auto  bg-white dark:bg-navy pb-12 shadow-xl">
                            <div class="flex px-4 pt-5 pb-2 group group:hover:cursor-pointer">
                                <button type="button" class="relative -m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-500 hover:text-gray-300 hover:cursor-pointer" @click="open = false">
                                    <span class="absolute -inset-0.5" />
                                    <span class="sr-only">Close menu</span>
                                    <XMarkIcon class="size-6 " aria-hidden="true" />
                                </button>
                            </div>

                            <CategoryDropdown :navigation="navigation" />
                            <div class="border border-b-gold"></div>
                            <div class="space-y-6 px-4 py-6">

                                <div v-for="page in navigation.pages" :key="page.name" class="flow-root">
                                    <Link :href="page.href" class="flex flex-row items-start gap-x-1 -m-2 p-2 font-medium text-navy dark:text-gray-200 hover:bg-gold dark:hover:text-black  rounded-md">
                                        <component :is="page.icon" class="size-5"></component>
                                        {{ page.name }}
                                    </Link>
                                </div>
                            </div>

                            <div class="space-y-6 border-t dark:border-gold border-gray-200 px-4 py-6">
                                <div class="flow-root">
                                    <Link href="#" class="flex flex-row items-center gap-x-1 -m-2 p-2 font-medium text-navy dark:text-gray-200 hover:bg-gold dark:hover:text-black  rounded-md">
                                        <UserIcon class="size-5" />
                                        Masuk/Daftar
                                    </Link>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <header class="relative">
            <nav aria-label="Top">
                <!-- Top navigation -->


                <!-- Secondary navigation -->
                <div class="fixed  z-10 bg-gray-300/80 w-full dark:bg-gray-900/70 backdrop-blur supports-[backdrop-filter]:bg-gray-300/60  dark:text-gray-100 shadow-sm">
                    <div class="bg-navy dark:bg-black dark:text-gray h-8 flex items-center">
                        <p class="text-sm font-medium mx-auto text-white dark:text-gray"><InfoRotator :items="rotatorText" /></p>
                    </div>
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="border-b border-gray-200">
                            <div class="flex h-16 items-center justify-between">
                                <!-- Logo (lg+) -->
                                <div class="hidden lg:flex lg:items-center">
                                    <Link :href="route('home')">
                                        <span class="sr-only">{{appName}}</span>
                                        <img class="h-8 w-auto" :src="companyLogo" alt="" />
                                    </Link>
                                </div>

                                <div class="hidden h-full lg:flex">
                                    <!-- Mega menus -->
                                    <PopoverGroup class="inset-x-0 bottom-0 px-4">
                                        <div class="flex h-full justify-center space-x-8">
                                            <Popover v-for="category in navigation.categories" :key="category.name" class="flex" v-slot="{ open }">
                                                <div class="relative flex">

                                                    <PopoverButton
                                                        class="hover:cursor-pointer"
                                                        :class="[open ? 'text-magenta dark:text-gold' : 'text-gray-700 dark:text-gray-300 hover:text-magenta dark:hover:text-gold', 'relative flex items-center justify-center text-sm font-medium transition-colors duration-200 ease-out space-x-2']">
                                                        {{ category.name }}
                                                        <span :class="[open ? 'bg-magenta dark:bg-gold' : 'hover:text-magenta dark:hover:text-gold', 'absolute inset-x-0 -bottom-px z-30 h-0.5 transition duration-200 ease-out']" aria-hidden="true" />
                                                    </PopoverButton>
                                                </div>
                                                <transition v-if="category.collection || category.brands || category.categories" enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0" enter-to-class="" leave-active-class="transition ease-in duration-150" leave-from-class="" leave-to-class="opacity-0">
                                                    <PopoverPanel class="absolute inset-x-0 top-full z-20 w-full bg-white text-sm text-gray-500">
                                                        <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                                                        <div class="absolute inset-0 top-1/2 bg-white shadow-sm" aria-hidden="true" />
                                                        <div class="relative bg-white dark:bg-navy">
                                                            <div class="mx-auto max-w-7xl px-8">
                                                                <div class="grid grid-cols-3 gap-x-4 gap-y-10 pt-10 pb-12">
                                                                    <div v-if="category.categories">

                                                                        <div >
                                                                            <p id="desktop-categories-heading" class="font-medium text-navy dark:text-gold">Kategori</p>
                                                                            <ul role="list" aria-labelledby="desktop-categories-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                                <li v-for="item in category.categories" :key="item.name" class="flex">
                                                                                    <a :href="item.href" class="dark:text-gray hover:text-gray-800 dark:hover:text-white">
                                                                                        {{ item.name }}
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <p id="desktop-collection-heading" class="font-medium text-navy dark:text-gold">Koleksi</p>
                                                                        <ul role="list" aria-labelledby="desktop-collection-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                            <li v-for="item in category.collection" :key="item.name" class="flex">
                                                                                <a :href="item.href" class="dark:text-gray hover:text-gray-800 dark:hover:text-gray-300">{{ item.name }}</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                    <div>
                                                                        <p id="desktop-brand-heading" class="font-medium text-navy dark:text-gold">Merk</p>
                                                                        <ul role="list" aria-labelledby="desktop-brand-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                            <li v-for="item in category.brands" :key="item.name" class="flex">
                                                                                <a :href="item.href" class="dark:text-gray hover:text-gray-800 dark:hover:text-gray-300">{{ item.name }}</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </PopoverPanel>
                                                </transition>
                                            </Popover>

                                            <Link v-for="page in navigation.pages" :key="page.name" :href="page.href" class="flex items-center text-sm font-medium text-navy dark:text-gray-300 hover:text-magenta dark:hover:text-gold">
                                                {{ page.name }}
                                            </Link>
                                        </div>
                                    </PopoverGroup>
                                </div>

                                <!-- Mobile menu and search (lg-) -->
                                <div class="flex flex-1 items-center lg:hidden">
                                    <button type="button" class="-ml-2 text-gray-500 hover:text-gray-300 hover:cursor-pointer" @click="open = true">
                                        <span class="sr-only">Open menu</span>
                                        <Bars3Icon class="size-6" aria-hidden="true" />
                                    </button>

                                    <!-- Search -->
                                    <a href="#" class="ml-2 p-2 text-gray-500  hover:text-gray-300">
                                        <span class="sr-only">Search</span>
                                        <MagnifyingGlassIcon class="size-6" aria-hidden="true" />
                                    </a>
                                </div>

                                <!-- Logo (lg-) -->
                                <a href="#" class="lg:hidden">
                                    <span class="sr-only">{{appName}}</span>
                                    <img :src="companyLogo" alt="" class="h-8 w-auto" />
                                </a>

                                <div class="flex flex-1 items-center justify-end">
                                    <div class="flex items-center lg:ml-8">
                                        <div class="flex space-x-8">
                                            <div class="hidden lg:flex">
                                                <a href="#" class="-m-2 p-2 text-gray-500 hover:text-gray-300">
                                                    <span class="sr-only">Search</span>
                                                    <MagnifyingGlassIcon class="size-6" aria-hidden="true" />
                                                </a>
                                            </div>

                                            <div class="flex">
                                                <a href="#" class="-m-2 p-2 text-gray-500 hover:text-gray-300">
                                                    <span class="sr-only">Account</span>
                                                    <UserIcon class="size-6" aria-hidden="true" />
                                                </a>
                                            </div>
                                        </div>

                                        <span class="mx-4 h-6 w-px bg-gray-500 lg:mx-6" aria-hidden="true" />

                                        <div class="flow-root">
                                            <a href="#" class="group -m-2 flex items-center p-2">
                                                <ShoppingCartIcon class="size-6 shrink-0 text-gray-500  hover:text-gray-300" aria-hidden="true" />
                                                <span class="inline-flex items-center rounded-full bg-red-700 px-2 py-1 text-xs font-medium text-red-200">2</span>
                                                <span class="sr-only">items in cart, view bag</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

        </header>

    </div>
</template>

<script setup>
import { computed, inject, ref } from 'vue';
import InfoRotator from '../layout/InfoRotator.vue';

import {
    Dialog,
    DialogPanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {
    Bars3Icon, BuildingStorefrontIcon,
    MagnifyingGlassIcon,
    PencilSquareIcon,
    ShoppingCartIcon,
    UserIcon,
    XMarkIcon
} from '@heroicons/vue/24/outline';

import { Link, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import CategoryDropdown from '../UI/navbar/CategoryDropdown.vue';
import {
    IconBag,
    IconRacket,
    IconShoe,
    IconShirt, IconShuttlecock
} from '../../../../../../resources/js/icons.js';


const companyLogo = inject('companyLogo')
const appName = computed(() => usePage().props.app.name)

const rotatorText = [
    `Dapatkan harga khusus dengan menjadi <a href="#" class="underline text-gold dark:brightness-80" data-inertia>member!</a>`,
    `Para sultan merapat! Nanoflare 1000ZZ bisa dibeli <a href="#" class="text-gold underline" data-inertia>di sini</a>.`,
    `Cobain deh, menu baru spesial: <span class="text-gold">Ayam Katsu Blackpepper</span>`,
    // `Para sultan merapat! Nanoflare 1000ZZ bisa dibeli <a href="${route('products.show', { slug: productSlug })}" class="text-gold underline" data-inertia>di sini</a>`,
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
        { name: "Shuttlecocks", icon: IconShuttlecock },

    ],
    pages: [
        { name: 'Booking', href: route('schedule.booking'), icon: PencilSquareIcon },
        { name: 'Resto', href: '#', icon: BuildingStorefrontIcon },
    ],
}

const open = ref(false)
</script>

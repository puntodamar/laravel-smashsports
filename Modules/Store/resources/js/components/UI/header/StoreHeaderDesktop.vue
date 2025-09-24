<template>
    <header class="relative">
        <nav aria-label="Top">

            <!-- Secondary navigation -->
            <div class="fixed  z-10 bg-gray-300/80 w-full dark:bg-gray-900/70 backdrop-blur supports-[backdrop-filter]:bg-gray-300/60  dark:text-gray-100 shadow-sm">
                <div class="bg-navy dark:bg-black dark:text-gray h-8 flex items-center">
                    <p class="text-sm font-medium mx-auto text-white dark:text-gray"><InfoRotator :items="props.rotatorText" /></p>
                </div>
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="border-b border-gray-200">
                        <div class="flex h-16 items-center justify-between">
                            <!-- Logo (lg+) -->
                            <div class="hidden lg:flex lg:items-center">
                                <Link :href="route('home')">
                                    <span class="sr-only">{{props.appName}}</span>
                                    <img class="h-8 w-auto" :src="tokoStore.companyLogo" alt="" />
                                </Link>
                            </div>

                            <div class="hidden h-full lg:flex">
                                <!-- Mega menus -->
                                <PopoverGroup class="inset-x-0 bottom-0 px-4">
                                    <div class="flex h-full justify-center space-x-8">
                                        <Popover v-for="category in tokoStore.navigation.categories" :key="category.name" class="flex" v-slot="{ open }">
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
                                                                        <p id="desktop-categories-heading" class="font-medium text-magenta dark:text-gold">Kategori</p>
                                                                        <ul role="list" aria-labelledby="desktop-categories-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                            <li v-for="item in category.categories" :key="item.name" class="flex">
                                                                                <a :href="item.href" class="dark:text-gray hover:text-gray-800 dark:hover:text-white">
                                                                                    {{ item.name }}
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div v-if="category.collection">
                                                                    <p id="desktop-collection-heading" class="font-medium text-magenta dark:text-gold">Koleksi</p>
                                                                    <ul role="list" aria-labelledby="desktop-collection-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                        <li v-for="item in category.collection" :key="item.name" class="flex">
                                                                            <a :href="item.href" class="dark:text-gray hover:text-gray-800 dark:hover:text-gray-300">{{ item.name }}</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                                <div v-if="category.brands">
                                                                    <p id="desktop-brand-heading" class="font-medium text-magenta dark:text-gold">Merk</p>
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

                                        <Link v-for="page in tokoStore.navigation.pages" :key="page.name" :href="page.href" class="flex items-center text-sm font-medium text-navy dark:text-gray-300 hover:text-magenta dark:hover:text-gold">
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
                                <img :src="tokoStore.getCompanyLogo" alt="" class="h-8 w-auto" />
                            </a>

                            <div class="flex flex-1 items-center justify-end">
                                <div class="flex items-center lg:ml-8">
                                    <div class="flex space-x-8">
                                        <div class="hidden lg:flex">
                                            <a href="#" class="-m-2 p-2 text-gray-400 hover:text-gray-500  dark:text-gray-500 dark:hover:text-gray-400">
                                                <span class="sr-only">Search</span>
                                                <MagnifyingGlassIcon class="size-6" aria-hidden="true" />
                                            </a>
                                        </div>

                                        <div v-if="userStore.getUser" class="flex">
                                            <UserDropdown  v-if="userStore.getUser" class="text-gray-400 hover:text-gray-500  dark:text-gray-500 dark:hover:text-gray-400"  :username="userStore.getUser.name.split(' ')[0]"/>
<!--                                            <a href="#" class="-m-2 p-2 flex flex-row items-center justify-center text-gray-500 hover:text-gray-400">-->
<!--                                                <span class="sr-only">Account</span>-->
<!--                                                <UserIcon class="size-6" aria-hidden="true" />-->
<!--                                                <span class="text-xs">{{userStore.getUser.name.split(" ")[0]}}</span>-->
<!--                                            </a>-->
                                        </div>
                                    </div>

                                    <span v-if="userStore.getUser" class="mx-4 h-6 w-px bg-gray-500 lg:mx-6" aria-hidden="true" />

                                    <div v-if="userStore.getUser" class="flow-root group">
                                        <a href="#" class="group -m-2 flex items-center p-2">
                                        <span class="relative inline-block">
                                          <ShoppingCartIcon
                                              class="size-6 shrink-0 text-gray-400 hover:text-gray-500  dark:text-gray-500 dark:hover:text-gray-400"
                                              aria-hidden="true"
                                          />
                                        <span
                                            v-if="cartCount === 0"
                                            class="absolute -bottom-1 -right-1 inline-flex h-4 min-w-[1rem] items-center justify-center
                                                 rounded-full bg-red-700 px-1 text-[10px] font-medium leading-none text-red-50
                                                 opacity-70 dark:opacity-80 group-hover:opacity-100 transition-opacity duration-200">
                                          {{ cartCount }}
                                        </span>
                                        </span>
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
</template>

<script setup>
import { route } from 'ziggy-js';
import { Popover, PopoverButton, PopoverGroup, PopoverPanel } from '@headlessui/vue';
import InfoRotator from '../../layout/InfoRotator.vue';
import { Bars3Icon, MagnifyingGlassIcon, ShoppingCartIcon, UserIcon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';
import { useTokoStore } from '@store/js/stores/toko_store.js';
import { useUserStore } from '@store/js/stores/user_store.js';
import UserDropdown from '@/components/UI/navbar/UserDropdown.vue';

const tokoStore = useTokoStore();
const cartStore = useTokoStore()
const userStore = useUserStore()

const cartCount = computed(() => cartStore.cartItems.length)
const props = defineProps({
    appName: {type: String, required: true},
    rotatorText: {type: Array, required: true},
})

console.log(userStore.getUser)

const open = inject('open')
</script>

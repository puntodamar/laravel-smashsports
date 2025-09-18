<template>


    <main class="mx-auto max-w-7xl sm:px-6 sm:py-16 lg:px-8">

        <div class="mx-auto max-w-2xl lg:max-w-none">
            <Breadcrumbs/>
            <!-- Product -->
            <div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
                <!-- Image gallery -->
                <ImageGallery :images="product.images" />

                <!-- Product info -->
                <div class="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0">
                    <h1 class="text-3xl font-bold tracking-tight text-navy dark:text-white">{{ product.name }}</h1>

                    <div class="mt-3">
                        <h2 class="sr-only">Product information</h2>

                        <div class="flex flex-row items-center gap-x-2">
                            <span class="block text-xs line-through text-red-500">Rp 3.300.000</span>
                            <span class="items-center rounded-sm bg-red-300 text-red-800 px-2 py-1 text-xs font-light">-30%</span>
                        </div>
                        <span class="block text-3xl font-semibold tracking-tight text-green-700 mt-2">{{ product.price }}</span>
                    </div>


                    <div class="mt-3">
                        <span class="font-light text-gray-500 dark:text-gray text-xs">Stok: {{product.stock}}</span>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>
                        <div class="space-y-6 text-base text-gray-500 dark:text-gray" v-html="product.description" />
                    </div>

                    <form @submit.prevent="addToCart" class="mt-6">

                        <div class="mt-10 flex">

                            <button
                                type="submit"
                                class="flex max-w-xs flex-1 flex-row gap-2 items-center justify-center rounded-md border border-transparent bg-gold dark:opacity-80 px-8 py-3 text-base font-medium text-navy  sm:w-full"
                            :class="[product.stock > 0 ? 'hover:opacity-100 hover:cursor-pointer' : 'opacity-50 hover:cursor-not-allowed']">

                                <div v-if="addToCartProgress.inProgress" class="flex flex-row items-center gap-x-2"><LoadingSpinner height="h-5" width="w-5" /> Menambahkan</div>
                                <div v-else class="flex flex-row items-center gap-x-2"><ShoppingCartIcon class="size-5"/> Masukkan keranjang </div>
                            </button>


                            <button type="button" class="ml-4 flex items-center justify-center rounded-md px-3 py-3 ">
<!--                                <HeartIcon class="size-6 shrink-0" aria-hidden="true" />-->
                                <HeartIconSolid class="size-6 shrink-0 text-electric-magenta" aria-hidden="true"  />
                                <span class="sr-only">Wishlist</span>
                            </button>
                        </div>
                    </form>
                    <Transition
                        enter-active-class="transition-opacity duration-200 ease-out"
                        enter-from-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="transition-opacity duration-200 ease-in"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0"
                    >

                        <div class="h-5 mt-2">
                            <span
                                v-show="addToCartProgress.inProgress && addToCartProgress.message"
                                class="inline-flex items-center rounded-sm px-2 py-1 text-xs font-light transition-opacity duration-200 ease-out"
                                :class="addToCartProgress.success ? 'bg-green-300 text-green-800' : 'bg-red-300 text-red-800'"
                            >
                            {{ addToCartProgress.message }}
                            </span>
                        </div>

                    </Transition>

                    <section aria-labelledby="summary-heading" class="mt-16">
                        <h2 id="summary-heading" class="text-lg font-bold text-navy dark:text-white">Spesifikasi</h2>

                        <div class="mt-6 grid grid-cols-[10rem_1fr] gap-x-10 gap-y-2">
                            <div class="text-gray-800 dark:text-gray-400">Flex</div>
                            <div class="text-gray-500 dark:text-gray-400 font-light">Stiff</div>

                            <div class="text-navy dark:text-gray-400">Frame</div>
                            <div class="text-gray-500 dark:text-gray-400 font-light">HM Graphite, NANOMETRIC DR, M40X, EX-HYPER MG</div>

                            <div class="text-navy dark:text-gray-400">Stringing Advice</div>
                            <div class="text-gray-500 dark:text-gray-400 font-light">4U: 20 - 28 lbs <br/> 3U: 21 - 29 lbs</div>

                            <div class="text-navy dark:text-gray-400">Shaft</div>
                            <div class="text-gray-500 dark:text-gray-400 font-light">HM Graphite, Ultra PE FIBER</div>
                        </div>
                    </section>

                </div>
            </div>

            <section aria-labelledby="related-heading" class="mt-10 border-t border-gray-200 px-4 py-16 sm:px-0">
                <ProductGrid title="Produk terkait" :icon="IconRacket" />
            </section>
        </div>
    </main>

</template>

<script setup>
import { defineOptions, reactive } from 'vue';
import { HeartIcon, ShoppingCartIcon } from '@heroicons/vue/24/outline'
import { HeartIcon as HeartIconSolid } from'@heroicons/vue/24/solid';
import StoreLayout from '@store/js/Layouts/StoreLayout.vue';
import ImageGallery from '@store/js/components/layout/detail/ImageGallery.vue';
import { IconRacket } from '@/icons.js';
import ProductGrid from '@store/js/components/layout/ProductGrid.vue';


import raket1 from '@assets/images/raket1.webp'
import raket2 from '@assets/images/raket2.jpg'
import raket3 from '@assets/images/raket3.jpg'
import raket4 from '@assets/images/raket4.webp'
import Breadcrumbs from '@store/js/components/layout/detail/Breadcrumbs.vue';
import { useCartStore } from '@store/js/stores/cart_store.js';
import LoadingSpinner from '@/components/UI/LoadingSpinner.vue';

const addToCartProgress = reactive({inProgress: null, success: null, message: null})
const cartStore = useCartStore()
let timer


const addToCart = () => {
    if(product.stock === 0) return;
    clearTimeout(timer)
    addToCartProgress.inProgress = true
    console.log(addToCartProgress)

    // simulate api call
    setTimeout(() => {
        if (product.stock > 0) {

            cartStore.addToCart(product.name)
            addToCartProgress.success = true
            addToCartProgress.message = "Berhasil ditambahkan!"
            product.stock -= 1
        } else {
            addToCartProgress.success = false
            addToCartProgress.message = "Stok tidak tersedia!"
        }

        timer = setTimeout(() => {
            addToCartProgress.inProgress = false
            addToCartProgress.success = null
            addToCartProgress.message = null
        }, 1000)
    },300)

}

const product = {
    name: 'Astrox 1000 Z',
    price: 'Rp 3.000.000',
    rating: 4,
    stock: 1,
    images: [
        {
            id: 1,
            name: 'Angled view',
            src: raket1,

        },
        {
            id: 2,
            name: 'Front view',
            src: raket2,

        },
        {
            id: 3,
            name: 'Back view',
            src: raket3,

        },
        {
            id: 4,
            name: 'Back angle open view',
            src: raket4,
        },
    ],
    description: `<p>For advanced players looking for immediate access to power to maintain a relentless attack</p>`,
}

defineOptions({
    layout: (h, page) =>
        h(StoreLayout, {title: 'Astrox 1000 ZZ'}, {
            default: () => page,
        }),
})

</script>

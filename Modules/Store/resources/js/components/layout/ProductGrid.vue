<template>

    <div :id="props.title.concat(' ', '')" class="mb-20 md:mt-0 md:mb-0">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <h2 class="text-2xl font-bold tracking-tight text-navy dark:text-white">{{props.title}}</h2>
                <a href="#" class="hidden text-sm font-medium text-magenta 0 dark:text-gold md:block">
                    Lihat lebih banyak
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-x-4 gap-y-10 sm:gap-x-6 md:grid-cols-4 md:gap-y-0 lg:gap-x-8">
                <div v-for="product in products" :key="product.id" class="group relative">
                    <div class="h-56 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:h-72 xl:h-80">
<!--                        <img :src="product.imageSrc" :alt="product.imageAlt" class="size-full object-cover" />-->
                        <svg class="size-full border border-gray-300 bg-white text-gray-300 dark:border-white/15 dark:bg-gray-900 dark:text-white/15" preserveAspectRatio="none" stroke="currentColor" fill="none" viewBox="0 0 200 200" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-width="1" d="M0 0l200 200M0 200L200 0" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-sm text-gray-700 dark:text-gray-300">
                        <a :href="product.href">
                            <span class="absolute inset-0" />
                            {{ product.name }}
                        </a>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray">{{ product.color }}</p>
                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ product.price }}</p>
                </div>
            </div>

            <div class="mt-8 text-sm md:hidden">
                <a href="#" class="font-medium text-magenta 0 dark:text-gold">
                    Lihat lebih banyak
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    title: {type: String, required: true},

})

const products = [
    {
        id: 1,
        name: 'Produk 1',
        color: 'Natural',
        price: 'Rp 100.000',
        href: '#',
        imageSrc: 'https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-04-trending-product-02.jpg',
        imageAlt: 'lorem   ',
    },
    {
        id: 2,
        name: 'Produk 2',
        color: 'Black',
        price: 'Rp 100.000',
        href: '#',
        imageSrc: 'https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-04-trending-product-03.jpg',
        imageAlt: '12-sided, machined black pencil and pen.',
    },
    {
        id: 3,
        name: 'Produk 3',
        color: 'Light Brown',
        price: 'Rp 100.000',
        href: '#',
        imageSrc: 'https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-04-trending-product-04.jpg',
        imageAlt: 'Set of three light and dark brown mini sketch books.',
    },
    {
        id: 4,
        name: 'Produk 4',
        color: 'Walnut',
        price: 'Rp 100.000',
        href: '#',
        imageSrc: 'https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-04-trending-product-01.jpg',
        imageAlt: 'Beautiful walnut organizer set with multiple white compartments',
    },
]
</script>

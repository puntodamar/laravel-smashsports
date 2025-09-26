<template>

    <div :id="props.title.concat(' ', '')" class="mb-20 md:mt-0 md:mb-0">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <div   class="md:flex md:items-center md:justify-between">
                <h2 class="flex flex-row items-center gap-2 text-xl md:text-2xl font-bold tracking-tight text-navy dark:text-white">
                    <component :is="props.icon" class="size-5" />{{props.title}}</h2>
                <Link v-if="showMore"  :href="route('store.product.filter-by-type', {product_type: props.title.toLowerCase()})" class="hidden text-sm font-medium text-navy 0 dark:text-gray hover:text-magenta dark:hover:text-electric-magenta md:block">
                    Lihat lebih banyak
                    <span aria-hidden="true"> &rarr;</span>
                </Link>
            </div>

            <div class=" mt-6 grid grid-cols-2 gap-x-4 gap-y-10 sm:gap-x-6 md:grid-cols-4 md:gap-y-0 lg:gap-x-8">
                <div v-for="item in props.items" :key="item.id" class="group relative">
                    <div class="h-40 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:h-65">
                        <img
                            v-if="item.primary_image"
                            :src="item.item"
                            class="size-full object-cover" />
                        <svg
                            v-else
                            class="size-full border border-gray-300 bg-gray-50 text-gray-300 dark:border-white/15 dark:bg-gray-900 dark:text-white/15" preserveAspectRatio="none" stroke="currentColor" fill="none" viewBox="0 0 200 200" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-width="1" d="M0 0l200 200M0 200L200 0" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-sm text-gray-700 dark:text-gray-300">
                        <Link :href="formatProductHref(item.sub_product, item.slug)">
                            <span class="absolute inset-0" />
                            <span class="group-hover:text-magenta dark:group-hover:text-electric-magenta text-xs md:text-base">{{ item.name }}</span>
                        </Link>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray">{{ item.color }}</p>
                    <p class="mt-1 text-sm font-medium text-pocari-blue dark:text-white group-hover:text-magenta dark:group-hover:text-electric-magenta text-xs md:text-base">{{ currencyFormatter(item.price) }}</p>
                </div>
            </div>

            <div v-if="showMore" class="mt-8 text-sm md:hidden">
                <Link href="#" class="font-medium text-navy hover:text-magenta dark:hover:text-electric-magenta dark:text-gray 0">
                    Lihat lebih banyak
                    <span aria-hidden="true"> &rarr;</span>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>

import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { currencyFormatter } from '@js/composables/currencyFormatter.js';

const props = defineProps({
    title: {type: String, required: true},
    icon: {type: Object, required: true},
    items: {type: Array},
    showMore: {type: Boolean, default: false},
})

const formatProductHref = (slug, itemSlug) => {
    slug = slug.split(".")
    return route('store.product.detail', { product_type: slug[0], sub_product: slug[1], product: itemSlug })
}
</script>

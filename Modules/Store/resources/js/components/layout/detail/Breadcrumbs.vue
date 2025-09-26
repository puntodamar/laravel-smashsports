<template>
    <nav  class="flex ml-2 md:ml-0 -mt-5 mb-10" aria-label="Breadcrumb">
        <ol role="list" class="flex items-center space-x-1">
            <li>
                <div>
                    <Link :href="route('store.index')" class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-300">
                        <HomeIcon class="size-5 shrink-0" aria-hidden="true" />
                        <span class="sr-only">Home</span>
                    </Link>
                </div>
            </li>
            <li v-for="page in pages" :key="page.name">
                <div class="flex items-center">
                    <ChevronRightIcon class="size-5 shrink-0 text-gray-400 dark:text-gray-500" aria-hidden="true" />
                    <a :href="page.href" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" :aria-current="page.current ? 'page' : undefined">{{ page.name }}</a>
                </div>
            </li>
        </ol>
    </nav>
</template>
<script setup>
import { route as ziggyRoute, useRoute } from 'ziggy-js';
import { ChevronRightIcon, HomeIcon } from '@heroicons/vue/20/solid';
import { Link } from '@inertiajs/vue3';

const route = useRoute()
const productType = ziggyRoute().params.product_type
const subProduct = ziggyRoute().params.sub_product

const breadcrumbFormatter = (slug) => {
    return slug.split(/[-_]/)
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ')
}

const pages = [
    {name : breadcrumbFormatter(productType), href: route('store.product.filter-by-type', {product_type: productType})},
    {name : breadcrumbFormatter(subProduct), href: route('store.product.filter-by-type', {product_type: productType, sub_product: subProduct}), current: true},
]

</script>

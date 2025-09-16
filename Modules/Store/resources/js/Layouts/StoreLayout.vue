<template>
    <Head :title="`${appName} | ${props.title}`" />
    <StoreHeader/>
    <div class="h-40 md:h-20"></div>
    <main class="bg-red">
        <Transition name="fade-slide" mode="out-in">
            <!-- Key by current URL (or $page.component) -->
            <div :key="transitionKey">
                <slot />
            </div>
        </Transition>
        <div class="fixed bottom-8 right-8 z-10">
            <PageTheme bg="bg-navy" text="text-white" />
        </div>
    </main>

    <Footer/>
</template>

<script setup>

import StoreHeader from '../components/UI/StoreHeader.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Footer from '@js/components/layout/Footer.vue';
import PageTheme from '@js/components/UI/PageTheme.vue'

const props = defineProps({
    title: {required: true, type: String, default: 'Toko' },
})

const page = usePage()
const transitionKey = computed(() => page.url)
const appName = computed(() => usePage().props.app.name)

</script>


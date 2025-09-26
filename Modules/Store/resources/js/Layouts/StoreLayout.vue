<template>
    <Head :title="`${appName} | ${ page.props?.title || props.title}`" />
    <StoreHeader :app-name="appName" />
    <div class="h-40 md:h-20"></div>
    <main class="bg-red">
        <Transition name="fade-slide" mode="out-in">
            <!-- Key by current URL (or $page.component) -->
            <div :key="transitionKey">
                <slot />
            </div>
        </Transition>
        <div class="fixed bottom-8 right-8 z-10">
            <PageTheme bg="bg-gold dark:bg-gold" text="text-black" />
        </div>
    </main>

    <Footer/>
</template>

<script setup>

import StoreHeader from '../components/UI/header/StoreHeader.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Footer from '@js/components/layout/Footer.vue';
import PageTheme from '@js/components/UI/PageTheme.vue'
import { useUserStore } from '@store/js/stores/user_store.js';

const page = usePage();
const appName = computed(() => page.props.app?.name || "Smash Sports")

const userStore = useUserStore()
if (page.props.auth?.user && !userStore.getUser) {
    userStore.setUser(page.props.auth?.user)
}

const props = defineProps({
    title: {required: false, type: String},
})

const transitionKey = computed(() => page.url)

</script>


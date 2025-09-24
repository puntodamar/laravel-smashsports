<template>
    <Head :title="`${appName} | ${props.title}`"></Head>
    <Header v-if="props.header" :dynamic="props.dynamicHeader"/>
    <main>
        <slot name="header" />
        <Transition name="fade-slide" mode="out-in">
            <!-- Key by current URL (or $page.component) -->
            <div :key="transitionKey">
                <slot />
            </div>
        </Transition>
    </main>

    <ScrollToTop  />
    <Footer v-if="footer" />
</template>

<script setup>
    import Footer from '@/components/layout/Footer.vue';
    import ScrollToTop from '@/components/UI/ScrollToTop.vue';
    import { Head, usePage } from '@inertiajs/vue3';
    import { computed, defineProps, onMounted } from 'vue';
    import Header from '@/components/layout/header/Header.vue';
    import { useUserStore } from '@store/js/stores/user_store.js';

    const page = usePage();
    const userStore = useUserStore()
    if (page.props.auth?.user && !userStore.getUser) {
        userStore.setUser(page.props.auth?.user)
    }

    const appName = computed(() => usePage().props.app.name)

    onMounted(async () => {
        // const { InertiaProgress } = await import('@inertiajs/progress')
        // InertiaProgress.init()
    })

    const transitionKey = computed(() => page.url)

    const props = defineProps({
        title: {type: String, default: "Your One Stop Badminton Center"},
        header: {type: Boolean, default: true},
        footer: {type: Boolean, default: true},
        dynamicHeader: {type: Boolean, default: false},

    })


</script>

<style scoped>
.fade-slide-enter-active, .fade-slide-leave-active {
    transition: opacity 200ms ease, transform 200ms ease;
}
.fade-slide-enter-from, .fade-slide-leave-to {
    opacity: 0;
    transform: translateY(6px);
}
</style>

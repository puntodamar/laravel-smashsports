<template>
    <Head :title="props.title"></Head>
    <Header v-if="props.header" :dynamic="props.dynamicHeader"/>
    <main>
        <slot name="header" />
        <slot />
    </main>

    <ScrollToTop  />
    <Footer v-if="footer"></Footer>
</template>

<script setup>
    import Footer from '@/components/layout/Footer.vue';
    import ScrollToTop from '@/components/UI/ScrollToTop.vue';
    import { Head } from '@inertiajs/vue3';
    import { defineProps, onMounted } from 'vue';
    import Header from '@/components/layout/Header.vue';

    onMounted(async () => {
        // const { InertiaProgress } = await import('@inertiajs/progress')
        // InertiaProgress.init()
    })

    const props = defineProps({
        title: {type: String, default: "Smash Sports | Your One Stop Badminton Center"},
        header: {type: Boolean, default: true},
        footer: {type: Boolean, default: true},
        dynamicHeader: {type: Boolean, default: false},

    })
</script>

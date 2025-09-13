<template>
    <Head :title="props.title"></Head>
    <main>
        <slot name="header" />
        <slot name="body"/>
    </main>

    <ScrollToTop />
    <Footer></Footer>
</template>

<script setup>
    import Footer from '@/components/layout/Footer.vue';
    import ScrollToTop from '@/components/UI/ScrollToTop.vue';
    import { Head } from '@inertiajs/vue3';
    import { defineProps, onMounted } from 'vue';

    onMounted(async () => {
        // const { InertiaProgress } = await import('@inertiajs/progress')
        // InertiaProgress.init()
    })

    const props = defineProps({
        title: {type: String, default: "Smash Sports | Your One Stop Badminton Center"},
    })
</script>

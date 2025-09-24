<template>
    <header :class="[baseHeader, (isOverHero && props.dynamic) ? overHeroClasses : afterHeroClasses]">
    <HeaderDesktop
        :app-name="appName"
        :company-logo="companyLogo"
        :navigation="navigation"
        :link-color="linkColor"
        :icon-color="iconColor" />

    <HeaderMobile
        :navigation="navigation"
        :app-name="appName"
        :company-logo="companyLogo"
        :icon-color="iconColor"
    />
    </header>
</template>

<script setup>
import HeaderDesktop from '@/components/layout/header/HeaderDesktop.vue';
import HeaderMobile from '@/components/layout/header/HeaderMobile.vue';
import { computed, defineProps, inject, onBeforeUnmount, onMounted, ref, provide } from 'vue';
import navigation from '@/navigation.js'
import { usePage } from '@inertiajs/vue3';

const isOverHero = ref(true)
const baseHeader = 'inset-x-0 top-0 z-50'
const overHeroClasses = 'absolute text-white'
const afterHeroClasses = 'fixed bg-gray-300/80 dark:bg-gray-900/70 backdrop-blur supports-[backdrop-filter]:bg-gray-300/60 text-slate-900 dark:text-gray-100 shadow-sm'
const mobileMenuOpen = ref(false)
const page = usePage()
const linkColor = computed(() => (isOverHero.value && props.dynamic ? 'text-white' : 'text-slate-900 dark:text-gray-100'))
const iconColor = computed(() => (isOverHero.value && props.dynamic ? 'text-white' : 'text-slate-900 dark:text-gray-100'))
const appName = computed(() => page.props.app.name)
const authUser = computed(() => page.props.auth?.user)

const companyLogo = inject('companyLogo')

provide('mobileMenuOpen', mobileMenuOpen)


let observer = null

const props = defineProps({
    dynamic: {required: false, type: Boolean, default: false},
})

onMounted(() => {

    const sentinel = document.getElementById('hero-sentinel')
    if (sentinel) {
        observer = new IntersectionObserver(
            ([entry]) => {
                isOverHero.value = (entry.isIntersecting || entry.boundingClientRect.top < 0);
            },

            {

                root: null,
                rootMargin: `-${getHeaderHeight()}px 0px 0px 0px`,
                threshold: 0,
            }
        )
        observer.observe(sentinel)
    } else {
        const onScroll = () => (isOverHero.value = window.scrollY < 10)
        window.addEventListener('scroll', onScroll, { passive: true })
        onBeforeUnmount(() => window.removeEventListener('scroll', onScroll))
    }
})

function getHeaderHeight() {
    // If your header has a fixed height, return that (e.g., 64).
    // Otherwise, measure dynamically:
    const el = document.querySelector('header')
    return el instanceof HTMLElement ? el.offsetHeight || 64 : 64
}

onBeforeUnmount(() => {
    observer?.disconnect()
})

</script>

<template>
    <button class="hover:cursor-pointer fixed z-40 right-4 bottom-4 md:right-6 md:bottom-6 mb-[env(safe-area-inset-bottom)] rounded-full p-3 shadow-lg ring-1 ring-black/10 dark:ring-white/10 bg-gold text-black hover:brightness-95 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold/60 transition duration-200 transform"
        :class="[visible ? 'opacity-100 scale-100 pointer-events-auto' : 'opacity-0 scale-95 pointer-events-none']"
        @click="scrollToTop"
        aria-label="Scroll to top">

        <ArrowUpIcon class="size-5" aria-hidden="true" />
    </button>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { ArrowUpIcon } from '@heroicons/vue/24/outline'

const visible = ref(false)
const threshold = 300 // px scrolled before showing the button

function onScroll() {
    visible.value = window.scrollY > threshold
}

function scrollToTop() {
    const reduce = window.matchMedia?.('(prefers-reduced-motion: reduce)').matches
    if (reduce) window.scrollTo(0, 0)
    else window.scrollTo({ top: 0, behavior: 'smooth' })
}

onMounted(() => {
    onScroll()
    window.addEventListener('scroll', onScroll, { passive: true })
})

onBeforeUnmount(() => {
    window.removeEventListener('scroll', onScroll)
})
</script>

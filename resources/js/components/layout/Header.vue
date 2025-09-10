<template>
    <header :class="[baseHeader, isOverHero ? overHeroClasses : afterHeroClasses]">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a :href="route('home')" class="-m-1.5 p-1.5">
                    <span class="sr-only">Smash Sports</span>
                    <img class="h-8 w-auto" :src="companyLogo" alt="" />
                </a>
            </div>

            <div class="flex items-center space-x-2 lg:hidden">
                <PageTheme />
                <div class="flex">
                    <button
                        type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5"
                        :class="iconColor"
                        @click="mobileMenuOpen = true"
                    >
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon class="size-6" aria-hidden="true" />
                    </button>
                </div>
            </div>

            <NavbarLinks :navigation="navigation" :text-color="linkColor" />

            <div class="hidden lg:flex lg:flex-1 flex-row lg:justify-end gap-x-5">
                <PageTheme />
                <div>
                    <a href="#" class="text-sm/6 font-semibold" :class="linkColor">Masuk/Daftar</a>
                </div>
            </div>
        </nav>

        <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
            <div class="fixed inset-0 z-50" />
            <DialogPanel
                class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white dark:bg-gray-800 p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
            >
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Smash Sports</span>
                        <img class="h-8 w-auto" :src="companyLogo" alt="" />
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5" :class="iconColor" @click="mobileMenuOpen = false">
                        <span class="sr-only">Close menu</span>
                        <XMarkIcon class="size-6" aria-hidden="true" />
                    </button>
                </div>

                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y dark:divide-gold divide-gray-200">
                        <div class="space-y-2 py-6">
                            <a
                                v-for="item in navigation.main"
                                :key="item.name"
                                :href="item.href"
                                class="flex flex-row items-center gap-x-2 -mx-3 rounded-lg px-3 py-2 text-base/7 font-semibold
                       text-black dark:text-gray-200 hover:bg-gold dark:hover:text-black"
                            >
                                <component :is="item.icon" class="size-5"></component>
                                {{ item.name }}
                            </a>
                        </div>
                        <div class="py-6">
                            <a href="#" class="flex flex-row items-center gap-x-2 -mx-3 rounded-lg px-3 py-2.5 text-base/7 font-semibold
                                text-black dark:text-gray-200 hover:bg-gold dark:hover:text-black">
                                <UserIcon class="size-5" />
                                Masuk/Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </DialogPanel>
        </Dialog>
    </header>
</template>

<script setup>
import { inject, ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon, UserIcon } from '@heroicons/vue/24/outline'
import PageTheme from '@/components/UI/PageTheme.vue';
import navigation from '@/navigation.js';
import NavbarLinks from '@/components/UI/NavbarLinks.vue';
import { route } from 'ziggy-js';

const isOverHero = ref(true)
const baseHeader = 'inset-x-0 top-0 z-50'
const overHeroClasses = 'absolute text-white'
const afterHeroClasses = 'fixed bg-gray-300/80 dark:bg-gray-900/70 backdrop-blur supports-[backdrop-filter]:bg-gray-300/60 text-slate-900 dark:text-gray-100 shadow-sm'

const linkColor = computed(() => (isOverHero.value ? 'text-white' : 'text-slate-900 dark:text-gray-100'))
const iconColor = computed(() => (isOverHero.value ? 'text-white' : 'text-slate-900 dark:text-gray-100'))

let observer = null

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

onBeforeUnmount(() => {
    observer?.disconnect()
})

function getHeaderHeight() {
    // If your header has a fixed height, return that (e.g., 64).
    // Otherwise, measure dynamically:
    const el = document.querySelector('header')
    return el instanceof HTMLElement ? el.offsetHeight || 64 : 64
}


const companyLogo = inject('companyLogo')

const mobileMenuOpen = ref(false)
</script>

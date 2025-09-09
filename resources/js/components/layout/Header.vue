<template>
    <header class="absolute inset-x-0 top-0 z-50 text-white dark:text-gray">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Smash Sports</span>
                    <img class="h-8 w-auto" :src="companyLogo" alt="" />
                </a>
            </div>


            <div class="flex items-center space-x-2 lg:hidden">
                <PageTheme></PageTheme>
                <div class="flex">
                    <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 dark:text-white" @click="mobileMenuOpen = true">
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon class="size-6" aria-hidden="true" />
                    </button>
                </div>
            </div>

            <NavbarLinks :navigation="navigation"></NavbarLinks>

            <div class="hidden lg:flex lg:flex-1 flex-row lg:justify-end gap-x-5">
<!--                desktop-->
                <PageTheme></PageTheme>
                <div><a href="#" class="text-sm/6 font-semibold text-white">Masuk <span aria-hidden="true">&rarr;</span></a></div>
            </div>
        </nav>

        <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
            <div class="fixed inset-0 z-50 " />

            <DialogPanel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white dark:bg-navy  p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10  ">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Smash Sports</span>
                        <img class="h-8 w-auto" :src="companyLogo" alt="" />
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 dark:text-white" @click="mobileMenuOpen = false">
                        <span class="sr-only">Close menu</span>
                        <XMarkIcon class="size-6" aria-hidden="true" />
                    </button>
                </div>

                <div class="mt-6 flow-root ">
                    <div class="-my-6 divide-y divide-gray dark:divide-gold">
                        <div class="space-y-2 py-6">
                            <a v-for="item in navigation.main" :key="item.name" :href="item.href" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-black dark:text-gray dark:hover:text-black hover:bg-gold ">{{ item.name }}</a>
                        </div>
                        <div class="py-6">
                            <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold  text-black dark:text-gray dark:hover:text-black">Masuk</a>
                        </div>

                    </div>
                </div>
            </DialogPanel>
        </Dialog>
    </header>
</template>

<script setup>
import { inject, ref } from 'vue';
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import PageTheme from '@/components/UI/PageTheme.vue';
import navigation from '../../../navigation.js';
import NavbarLinks from '@/components/UI/NavbarLinks.vue';

const companyLogo = inject('companyLogo')


const mobileMenuOpen = ref(false)
</script>

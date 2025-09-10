<template>
    <header class="inset-x-0 top-0 z-50 text-white dark:text-gray" :class="headerClass()">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8 bg-s" aria-label="Global">
            <div class="flex lg:flex-1">
                <a :href="route('home')" class="-m-1.5 p-1.5">
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

            <NavbarLinks :navigation="navigation" :text-color="textColor"></NavbarLinks>

            <div class="hidden lg:flex lg:flex-1 flex-row lg:justify-end gap-x-5">
<!--                desktop-->
                <PageTheme></PageTheme>
                <div><a href="#" :class="`text-sm/6 font-semibold ${textColor}`">Masuk/Daftar</a></div>
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
                            <a v-for="item in navigation.main" :key="item.name" :href="item.href" class="flex flex-row items-center gap-x-2 -mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-black dark:text-gray dark:hover:text-black hover:bg-gold ">
                                <component :is="item.icon" class="size-5"></component>
                                {{ item.name }}
                            </a>
                        </div>
                        <div class="py-6">
                            <a href="#" class="flex flex-row items-center gap-x-2 -mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold  text-black dark:text-gray dark:hover:text-black hover:bg-gold">
                                <UserIcon class="size-5"></UserIcon>
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
import { inject, ref, defineProps } from 'vue';
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon, UserIcon } from '@heroicons/vue/24/outline'
import PageTheme from '@/components/UI/PageTheme.vue';
import navigation from '@/navigation.js';
import NavbarLinks from '@/components/UI/NavbarLinks.vue';
import { route } from 'ziggy-js';

const props = defineProps({
    absolute: {type: Boolean, default: false},
    background: {type: Boolean, default: false},
    textColor: {type: String, default: 'text-white'},
})


const companyLogo = inject('companyLogo')
const headerClass = () => {
    let arrClass = []
    if(props.absolute === true) {
        arrClass.push('absolute')
    }

    if (props.background === true) {
        // dark:bg-gradient-to-b dark:from-navy dark:to-black
        arrClass = arrClass.concat(['border-b-black  border-1 dark:bg-gradient-to-b dark:from-black dark:to-navy dark:border-0'])
    }

    return arrClass
}

console.log(headerClass())

const mobileMenuOpen = ref(false)
</script>

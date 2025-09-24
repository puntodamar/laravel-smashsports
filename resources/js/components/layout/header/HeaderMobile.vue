<template>
    <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
        <div class="fixed inset-0 z-50" />
        <DialogPanel
            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white dark:bg-navy p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
                <Link :href="route('home')" class="-m-1.5 p-1.5">
                    <span class="sr-only">{{props.appName}}</span>
                    <img class="h-8 w-auto" :src="companyLogo" alt="" />
                </Link>
                <button type="button" class="-m-2.5 rounded-md p-2.5 hover:cursor-pointer" :class="props.iconColor" @click="mobileMenuOpen = false">
                    <span class="sr-only">Close menu</span>
                    <XMarkIcon class="size-6 text-black dark:text-white" aria-hidden="true" />
                </button>
            </div>

            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y dark:divide-gold divide-gray-200">
                    <div class="space-y-2 py-6">
                        <Link
                            v-for="item in navigation.main"
                            :key="item.name"
                            :href="item.href"
                            class="flex flex-row items-center gap-x-2 -mx-3 rounded-lg px-3 py-2 text-base/7 font-semibold
                       text-black dark:text-gray-200 hover:bg-gold dark:hover:text-black"
                        >
                            <component :is="item.icon" class="size-5"></component>
                            {{ item.name }}
                        </Link>
                    </div>
                    <div class="py-6">
                        <div v-if="authUser">
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                replace
                                @click="mobileMenuOpen = false"
                                class="flex flex-row items-center gap-x-2 -mx-3 rounded-lg px-3 py-2.5 text-base/7 font-semiboldtext-black dark:text-gray-200 hover:bg-gold dark:hover:text-black"
                            >
                                <ArrowRightEndOnRectangleIcon class="size-5" />
                                Logout
                            </Link>

                        </div>
                        <Link
                            v-else
                            :href="route('login')"
                            class="flex flex-row items-center gap-x-2 -mx-3 rounded-lg px-3 py-2.5 text-base/7 font-semibold text-black dark:text-gray-200 hover:bg-gold dark:hover:text-black">
                            <UserIcon class="size-5" />
                            Masuk/Daftar
                        </Link>
                    </div>
                </div>
            </div>
        </DialogPanel>
    </Dialog>
</template>
<script setup>
import { route } from 'ziggy-js';
import { Dialog, DialogPanel } from '@headlessui/vue';
import { UserIcon, XMarkIcon, ArrowRightEndOnRectangleIcon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';
import { inject, } from 'vue';

const props = defineProps({
    navigation: {type: Object, required: true},
    appName: {type: String, required: true},
    companyLogo: {type: String, required: true},
    iconColor: {type: String, required: true},
    authUser: {type: Object}
})

const mobileMenuOpen = inject('mobileMenuOpen')


</script>

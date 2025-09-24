<template>
    <TransitionRoot as="template" :show="open">
        <Dialog class="relative z-40 lg:hidden" @close="open = false">
            <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="" leave="transition-opacity ease-linear duration-300" leave-from="" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black/25" />
            </TransitionChild>
            <div class="fixed inset-0 z-40 flex">
                <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                    <DialogPanel class="relative flex w-full max-w-xs flex-col overflow-y-auto  bg-white dark:bg-navy pb-12 shadow-xl">
                        <div class="flex px-4 pt-5 pb-2 group group:hover:cursor-pointer">
                            <button type="button" class="relative -m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-300 hover:text-gray-500 hover:cursor-pointer" @click="open = false">
                                <span class="absolute -inset-0.5" />
                                <span class="sr-only">Close menu</span>
                                <XMarkIcon class="size-6 " aria-hidden="true" />
                            </button>
                        </div>

                        <CategoryDropdown :navigation="props.navigation" />
                        <div class="border-t border-gray-200  dark:border-gold"></div>
                        <div class="space-y-6 px-4 py-6 border-gray-200 ">
                            <div v-for="page in navigation.pages" :key="page.name" class="flow-root">
                                <Link :href="page.href" class="flex flex-row items-start gap-x-1 -m-2 p-2 font-medium text-navy dark:text-gray-200 hover:bg-gold dark:hover:text-black  rounded-md">
                                    <component :is="page.icon" class="size-5"></component>
                                    {{ page.name }}
                                </Link>
                            </div>
                        </div>

                        <div  class="space-y-6 border-t dark:border-gold border-gray-200 px-4 py-6">
                            <div class="flow-root">
                                <Link
                                    v-if="props.authUser"
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    replace
                                    @click="open = false"
                                    class="flex flex-row items-center gap-x-1 -m-2 p-2 font-medium text-navy dark:text-gray-200 hover:bg-gold dark:hover:text-black  rounded-md">
                                    <ArrowRightEndOnRectangleIcon class="size-5" />
                                    Logout
                                </Link>

                                <Link
                                    v-else
                                    :href="route('login')"
                                    class="flex flex-row items-center gap-x-1 -m-2 p-2 font-medium text-navy dark:text-gray-200 hover:bg-gold dark:hover:text-black  rounded-md">
                                    <UserIcon class="size-5" />
                                    Masuk/Daftar
                                </Link>


                            </div>
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>

</template>
<script setup>
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { UserIcon, XMarkIcon } from '@heroicons/vue/24/outline';
import CategoryDropdown from '../..//UI/navbar/CategoryDropdown.vue';
import { Link } from '@inertiajs/vue3';
import {inject} from 'vue'
import { route } from 'ziggy-js';
import { ArrowRightEndOnRectangleIcon } from '@heroicons/vue/24/outline/index.js';

const props = defineProps({
    navigation: {type: Object, required: true},
    authUser: {type: Object}
})
const open = inject('open');
</script>

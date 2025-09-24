<template>
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <Link :href="route('home')" class="-m-1.5 p-1.5">
                <span class="sr-only">{{props.appName}}</span>
                <img class="h-8 w-auto" :src="props.companyLogo" alt="" />
            </Link>
        </div>

        <div class="flex items-center space-x-2 lg:hidden">
            <PageTheme />
            <div class="flex">
                <button
                    type="button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 hover:cursor-pointer"
                    :class="props.iconColor"
                    @click="mobileMenuOpen = true"
                >
                    <span class="sr-only">Open main menu</span>
                    <Bars3Icon class="size-6" aria-hidden="true" />
                </button>
            </div>
        </div>

        <NavbarLinks :navigation="navigation" :text-color="props.linkColor"/>

        <div class="hidden lg:flex lg:flex-1 flex-row lg:justify-end gap-x-5">
            <PageTheme />
            <UserDropdown  v-if="userStore.getUser"  :username="userStore.getUser.name.split(' ')[0]"/>
            <Link
                v-else
                :href="route('login')"
                class="text-sm/6 font-semibold"
                :class="props.linkColor">
                Masuk/Daftar
            </Link>
        </div>
    </nav>
</template>

<script setup>
import { route } from 'ziggy-js';
import { Bars3Icon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';
import PageTheme from '@/components/UI/PageTheme.vue';
import NavbarLinks from '@/components/UI/NavbarLinks.vue';
import {defineProps, inject } from 'vue';
import UserDropdown from '@/components/UI/navbar/UserDropdown.vue';
import { useUserStore } from '@store/js/stores/user_store.js';

const userStore = useUserStore();
const mobileMenuOpen = inject('mobileMenuOpen')


const props = defineProps({
    appName: {type: String, required: true},
    companyLogo: {type: String, required: true},
    navigation: {type: Object, required: true},
    linkColor: {type: String, required: true},
    iconColor: {type: String},
})




</script>

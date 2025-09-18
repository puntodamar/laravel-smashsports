<template>
<!--    dark:bg-gradient-to-b dark:from-navy dark:to-black dark:text-white-->
    <footer class="border-t-1 border-t-gray-200  dark:border-t-gray-700 opacity-80 py-5 bg-gradient-to-b from-white to-gray-300 dark:from-gray-800 dark:to-navy" >
        <div class="mx-auto max-w-7xl px-6 py-4 lg:px-8">
            <div class="flex flex-col items-center gap-6 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex w-full sm:w-auto justify-center sm:justify-start items-start sm:items-center gap-3">
                    <div class="flex h-15 w-15 items-center justify-center">
                        <img :src="companyLogo" alt="">
                        <span class="sr-only text-gray-600 dark:text-white">{{appName}}</span>
                    </div>
                    <address class="not-italic text-sm leading-5 text-gray-600 dark:text-white text-center sm:text-left">
                        <div class="font-medium">{{appName}}</div>
                        <div>Jl. Olahraga No. 123, Yogyakarta</div>
                        <a href="mailto:hello@smashsports.id" class="underline hover:text-navy dark:hover:text-gold">hello@smashsports.id</a>
                    </address>
                </div>

                <nav aria-label="Social media" class="w-full sm:w-auto sm:ml-auto">
                    <div class="flex justify-center sm:justify-end gap-x-6 leading-none">
                        <a
                            v-for="item in navigation.social"
                            :key="item.name"
                            :href="item.href"
                            class="inline-flex items-center justify-center text-gray hover:text-navy dark:hover:text-gold dark:text-white">
                            <span class="sr-only">{{ item.name }}</span>
                            <component :is="item.icon" class="size-6 block" aria-hidden="true" />
                        </a>
                    </div>
                </nav>
            </div>

        </div>
    </footer>
</template>


<script setup>
    import navigation from '@/navigation.js';
    import { computed, inject } from 'vue';
    import { usePage } from '@inertiajs/vue3';
    const companyLogo = inject('companyLogo')

    const appName = computed(() => usePage().props.app?.name || "Smash Sports")
</script>

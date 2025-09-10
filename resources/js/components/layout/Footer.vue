<template>
<!--    dark:bg-gradient-to-b dark:from-navy dark:to-black dark:text-white-->
    <footer class="border-t-1 border-t-gray-400  dark:border-t-gray opacity-50 py-5 bg-gradient-to-b from-white to-gray-300 dark:from-gray-800 dark:to-navy" >
        <div class="mx-auto max-w-7xl px-6 py-4 lg:px-8">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                <!-- Left: dummy logo + address -->
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center">
                        <img :src="companyLogo" alt="">
                        <span class="sr-only text-gray-600 dark:text-white">Smash Sports</span>
                    </div>
                    <address class="not-italic text-sm leading-5 text-gray-600 dark:text-white">
                        <div class="font-medium">Smash Sports</div>
                        <div>Jl. Contoh No. 123, Jakarta</div>
                        <a href="mailto:hello@smashsports.id" class="underline hover:text-navy">hello@smashsports.id</a>
                    </address>
                </div>

                <!-- Right: social links -->
                <nav aria-label="Social media" class="sm:ml-auto">
                    <div class="flex justify-end gap-x-6 leading-none">
                        <a
                            v-for="item in navigation.social"
                            :key="item.name"
                            :href="item.href"
                            class="inline-flex items-center justify-center text-gray hover:text-navy dark:hover:text-gold dark:text-white"
                        >
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
    import { inject } from 'vue';
    const companyLogo = inject('companyLogo')
</script>

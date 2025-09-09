<template>
    <footer class="bg-black text-gray dark:outline-1 dark:outline-gray-100">
        <div class="mx-auto max-w-7xl overflow-hidden px-6 py-2 lg:px-8">
            <div class="mt-16 flex justify-center gap-x-10">
                <a v-for="item in navigation.social" :key="item.name" :href="item.href" class="hover:text-gold">
                    <span class="sr-only">{{ item.name }}</span>
                    <component :is="item.icon" class="size-6" aria-hidden="true" />
                </a>
            </div>
            <p class="mt-10 text-center text-sm/6 text-gray">&copy; 2025 Smash Sports</p>
        </div>
    </footer>
</template>

<script setup>
import navigation from '../../navigation.js';
</script>

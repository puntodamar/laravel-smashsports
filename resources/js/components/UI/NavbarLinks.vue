<!-- NavBarLinks.vue -->
<template>
    <nav class="relative hidden lg:flex lg:gap-x-12">
        <a
            v-for="item in navigation.main"
            :key="item.name"
            :href="item.href"
            :class="`group relative inline-flex items-center px-3 py-2 text-sm/6 font-semibold font-body  transition-colors duration-300 overflow-hidden rounded-md ${props.textColor}`">

            <span class="relative z-10 transition-colors duration-300 group-hover:text-black dark:group-hover:text-black">{{ item.name }}</span>

            <!-- bg slides UP -->
            <span class="absolute inset-0 -z-0 bg-gold rounded-md origin-bottom scale-y-0 group-hover:scale-y-100 transition-transform duration-300 ease-out will-change-transform" />
        </a>
    </nav>


</template>

<script setup>
import { ref } from 'vue'
import {route} from 'ziggy-js'

const props = defineProps({
    navigation: { type: Object, required: true },
    textColor: { type: String, default: 'text-white' },
})

</script>

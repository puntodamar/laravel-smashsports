<template>
    <button
        type="button"
        @click="toggle"
        :aria-pressed="selected.toString()"
        class="relative group w-full text-left flex flex-col items-center justify-center rounded-sm border-2 p-1 transition-colors hover:border-electric-magenta"
        :class="selected ? 'border-electric-magenta text-electric-magenta' : 'border-gray '">
        <div class="text-xs">{{time}}</div>
        <div class="text-xs opacity-50">{{price}}</div>

        <CheckCircleIcon
            aria-hidden="true"
            class="absolute bottom-2 right-2 size-5 text-electric-magenta
             transition-opacity"
            :class="selected ? 'opacity-100' : 'opacity-0 group-hover:opacity-50'" />
        <span class="sr-only">{{ selected ? 'Selected' : 'Not selected' }}</span>
    </button>
</template>

<script setup>
import { ref, defineProps } from 'vue'
import { CheckCircleIcon } from '@heroicons/vue/20/solid/index.js';


const props = defineProps({
    price: { type: String, required: true },
    time: {type: String, required: true},
})

const selected = ref(false)
const toggle = () => { selected.value = !selected.value }
</script>

<template>
    <button
        type="button"
        @click="toggle"
        :value="time"
        :name="`court[${props.courtId}]time[]`"
        :aria-pressed="selected.toString()"
        class="relative group w-full text-center flex flex-col items-center justify-center rounded-sm border-1 p-3 transition-colors hover:navy"
        :class="selected ? 'border-navy dark:border-gold  border-2 text-gray-900 dark:text-white ' : 'border-gray bg-gray-200 text-gray-600 dark:text-gray-400  dark:bg-gray-700 ' +
         ''">

        <div class="text-xs">{{time}}</div>
        <div class="text-xs opacity-50">{{price}}</div>

        <CheckCircleIcon
            aria-hidden="true"
            class="absolute bottom-2 right-2 size-5 text-navy dark:text-gold transition-opacity"
            :class="selected ? 'opacity-100 text-navy' : 'opacity-0 group-hover:opacity-50 text-gray-600'" />
        <span class="sr-only">{{ selected ? 'Selected' : 'Not selected' }}</span>
    </button>
</template>

<script setup>
import { ref, defineProps } from 'vue'
import { CheckCircleIcon } from '@heroicons/vue/20/solid/index.js';


const props = defineProps({
    courtId: {required: true, type: Number},
    price: { type: String, required: true },
    time: {type: String, required: true},
})


const selected = ref(false)
const toggle = () => { selected.value = !selected.value }
</script>

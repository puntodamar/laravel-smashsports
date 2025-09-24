<template>
    <div v-if="props.type ===  'status' && props.message" class="rounded-md bg-blue-50 p-4 dark:bg-blue-200/10 dark:outline dark:outline-blue-500/20">
        <div class="flex">
            <div class="shrink-0">
                <InformationCircleIcon class="size-5 text-blue-400" aria-hidden="true" />
            </div>
            <div class="ml-3 flex-1 md:flex md:justify-between">
                <p class="text-sm text-pocari-blue dark:text-blue-300">{{props.message}}</p>
                <p v-if="link" class="mt-3 text-sm md:mt-0 md:ml-6">
                    <a href="#" class="font-medium whitespace-nowrap text-pocari-blue dark:text-blue-300 dark:hover:text-blue-200">
                        Details
                        <span aria-hidden="true"> &rarr;</span>
                    </a>
                </p>
            </div>
        </div>
    </div>

    <div v-if="errorList.length && props.type === 'error'" class="rounded-md bg-red-50 p-4 mb-4 dark:bg-red-500/15 dark:outline dark:outline-red-500/25">
        <div  class="flex">
            <div class="shrink-0">
                <NoSymbolIcon class="size-5 text-red-400" aria-hidden="true" />
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-bold text-red-800 dark:text-red-200">{{props.message}}</h3>
                <div class="mt-2 text-sm text-red-800 dark:text-red-200/80">
                    <ul role="list" class="list-disc space-y-1 pl-5">
                        <li v-for="(error, i) in errorList" :key="i" class="font-light">{{error}}</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { InformationCircleIcon } from '@heroicons/vue/20/solid';
import { NoSymbolIcon } from '@heroicons/vue/20/solid/index.js';

const props = defineProps({
    type: {type: String, required: true},
    message: {type: String},
    link: {type: Object},
    errorList: {type: Array, default: []},
})


</script>

<template>
    <div class="w-full">
        <div class="grid grid-cols-1 sm:hidden">
            <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
            <select aria-label="Select a tab"
                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base
                    text-gray-900 outline-1 -outline-offset-1 outline-gold
                    focus:outline-2 focus:-outline-offset-2 focus:outline-gold dark:bg-gray dark:text-white dark:outline-white/10
                    dark:*:bg-gray-800 dark:focus:outline-indigo-500">
                <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
            </select>
            <ChevronDownIcon class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end fill-gray-500 dark:fill-gray-400" aria-hidden="true" />
        </div>
        <div class="hidden sm:block">
            <div class="border-b border-gray-200 dark:border-white/10">
                <nav class="-mb-px flex" aria-label="Tabs">
                    <a v-for="tab in tabs" :key="tab.name" :href="tab.href" @click="viewTab(tab.tabIndex)"
                       :class="[
                           tab.current ? 'border-electric-magenta text-electric-magenta' : 'border-transparent text-black hover:border-gray-300 hover:text-gray-700 dark:text-white ' +
                            'dark:hover:border-white/20 dark:hover:text-gray-300', 'w-1/4 border-b-2 px-1 py-4 text-center text-sm font-medium']"
                       :aria-current="tab.current ? 'page' : undefined">{{ tab.name }}

                        <span class="inline-flex items-center rounded-full bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 inset-ring inset-ring-gray-500/10 dark:bg-gray-400/10 dark:text-gray-400 dark:inset-ring-gray-400/20">{{tab.available}}</span>
                    </a>
                </nav>
            </div>
        </div>

        <div id="lapangan-1" v-show="tabIndex === 1" class="text-white">
            Lap 1
        </div>

        <div id="lapangan-2"  v-show="tabIndex === 2" class="text-white">
            Lap 2
        </div>

        <div id="lapangan-3" v-show="tabIndex === 3" class="text-white">
            Lap 3
        </div>

        <div id="lapangan-4" v-show="tabIndex === 4" class="text-white">
            Lap 4
        </div>
    </div>
</template>

<script setup>
import {ref} from "vue";
import { ChevronDownIcon } from '@heroicons/vue/16/solid'
const tabIndex = ref(1)
const tabs = [
    { tabIndex: 1, name: 'Lapangan 1', href: '#lapangan-1', current: true, available: 5 },
    { tabIndex: 2, name: 'Lapangan 2', href: '#lapangan-2', current: false, available: 0 },
    { tabIndex: 3,name: 'Lapangan 3', href: '#lapangan-3', current: false, available: 1, },
    { tabIndex: 4, name: 'Lapangan 4', href: '#lapangan-4', current: false, available: 0 },
]

const viewTab = (tab) => {
    tabs[tabIndex.value - 1].current = false
    tabIndex.value = tab
    console.log(tabIndex)
    tabs[tabIndex.value-1].current = true
}
</script>

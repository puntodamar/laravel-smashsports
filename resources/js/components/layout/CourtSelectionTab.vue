<template>
    <div class="w-full">
        <div class="grid grid-cols-1 sm:hidden">
            <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
            <select aria-label="Select a tab"
                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base
                    text-gray-900 outline-1 -outline-offset-1 outline-gray
                    focus:outline-2 focus:-outline-offset-2 focus:outline-gray dark:bg-navy dark:text-white
                    dark:*:bg-gray-800 ">
                <option v-for="(tab, i) in tabs" :key="tab.name" :selected="sortedTabs[0].tabIndex === tab.tabIndex">{{availableText(tabs[i].available, tab.name)}}</option>
            </select>
            <ChevronDownIcon class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end fill-gray-500 dark:fill-gray-400" aria-hidden="true" />
        </div>
        <div class="hidden sm:block">
            <div class="border-b border-gray-200 dark:border-white/10">
                <nav class="-mb-px flex" aria-label="Tabs">
                    <a v-for="tab in tabs" :key="tab.name" :href="tab.href" @click="viewTab(tab.tabIndex)"
                       @click.prevent="() => history.pushState(null, '', '#features')"
                       class="w-1/4 border-b-2 px-1 py-4 text-center text-sm font-medium"
                       :class="currentTabClass(tab.tabIndex)"
                       :aria-current="tab.current ? 'page' : undefined">{{ tab.name }}

                        <span class="inline-flex items-center rounded-full bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 inset-ring inset-ring-gray-500/10 dark:bg-gray-400/10 dark:text-gray-400 dark:inset-ring-gray-400/20">{{availableText(tab.available)}}</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="text-gray-600 dark:text-gray-400">
            <div id="lapangan-1" v-show="tabIndex === 1" >


            </div>

            <div id="lapangan-2"  v-show="tabIndex === 2" class="text-white">

            </div>

            <div id="lapangan-3" v-show="tabIndex === 3" class="text-white">
                <div class="grid grid-cols-4 gap-2 mt-5">
                    <CourtTimeGridItem :court-id="Number(3)" time="08:00 09:00" price="Rp 45.000"></CourtTimeGridItem>
                    <CourtTimeGridItem :court-id="Number(3)" time="09:00 10:00" price="Rp 45.000"></CourtTimeGridItem>
                </div>
            </div>

            <div id="lapangan-4" v-show="tabIndex === 4" class="text-white">
                <div class="grid grid-cols-4 gap-2 mt-5">
                    <CourtTimeGridItem :court-id="Number(4)" time="18:00 17:00" price="Rp 50.000"></CourtTimeGridItem>
                </div>
            </div>
        </div>


    </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import { ChevronDownIcon } from '@heroicons/vue/16/solid'
import CourtTimeGridItem from '@/components/UI/booking/CourtTimeGridItem.vue';


const tabs = ref([
    { tabIndex: 1, name: 'Lapangan 1', href: '#lapangan-1', current: false, available: 0 },
    { tabIndex: 2, name: 'Lapangan 2', href: '#lapangan-2', current: false, available: 0 },
    { tabIndex: 3, name: 'Lapangan 3', href: '#lapangan-3', current: false, available: 5, },
    { tabIndex: 4, name: 'Lapangan 4', href: '#lapangan-4', current: false, available: 1 },
])



const sortedTabs = computed(() =>
    [...tabs.value].sort((a, b) => {
        const byAvail = (b.available ?? 0) - (a.available ?? 0)
        if (byAvail) return byAvail
        return (a.tabIndex ?? 0) - (b.tabIndex ?? 0)
    })
)

const tabIndex = ref(sortedTabs.value[0].tabIndex)

const currentTabClass = computed(() => (tabIndex) => {
    const tab = tabs.value.find((t) => t.tabIndex === tabIndex)
    if (tab.current){
        // tabIndex.value = tab.tabIndex
        return ['border-navy', 'text-navy', 'dark:border-gold', 'dark:text-gold']
    } else {
        return ['border-transparent', 'text-black', 'dark:text-gray', 'dark:hover:text-white', 'hover:text-pocari-blue']
    }
})

onMounted(() => {
    sortedTabs.value[0].current = true
})

const viewTab = (tab) => {
    tabs.value[tabIndex.value - 1].current = false
    tabIndex.value = tab
    tabs.value[tabIndex.value-1].current = true
}

const availableText = (available, prefix = null, ) => {
    if (available > 0) {
        return (prefix) ? `${prefix} (${available} tersedia)` : `(${available} tersedia)`
    } else {
        return (prefix) ? `${prefix} (full)` : '(full)'
    }
}
</script>

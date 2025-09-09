<template>
    <div class="flex flex-col items-center">
        <h2 class="font-heading text-3xl font-semibold tracking-tight text-pretty text-black dark:text-gold">
            Pilih Lapangan
        </h2>

        <!-- Membership -->
        <h4 class="text-electric-magenta text-sm font-semibold mt-5">Jenis Paket</h4>
        <fieldset>
            <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                <label
                    v-for="m in membership"
                    :key="m.id"
                    :aria-label="m.title"
                    class="group relative flex rounded-lg border border-gray bg-white p-4
                 has-checked:outline-2 has-checked:-outline-offset-2 has-checked:outline-electric-magenta
                 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1
                 has-disabled:border-gray has-disabled:bg-gray has-disabled:opacity-25
                 dark:border-navy dark:bg-gray-900 dark:has-checked:bg-indigo-500/10"
                >
                    <input
                        type="radio"
                        name="membership"
                        :value="m.id"
                        v-model="selectedMembershipId"
                        class="absolute inset-0 appearance-none focus:outline-none cursor-pointer"
                    />
                    <div class="flex-1">
                        <span class="block text-sm font-medium text-gray-800 dark:text-white">{{ m.title }}</span>
                        <span v-if="m.description" class="mt-1 block text-xs text-gray-500 dark:text-gray-400">{{ m.description }}</span>
                    </div>
                    <CheckCircleIcon
                        class="invisible size-5 text-electric-magenta group-has-checked:visible dark:text-electric-magenta"
                        aria-hidden="true"
                    />
                </label>
            </div>
        </fieldset>

        <!-- Dates -->
        <h4 class="text-electric-magenta text-sm font-semibold mt-5">Pilih Tanggal</h4>
        <fieldset class="mt-5 px-5 w-full">
            <div class="mx-auto max-w-3xl grid grid-cols-2 gap-4 md:grid-cols-4 items-center">
                <!-- 3 quick dates -->
                <label
                    v-for="d in days"
                    :key="d.value"
                    :aria-label="d.label"
                    class="group relative flex items-center justify-center rounded-lg border border-gray bg-white p-4
                 has-checked:outline-2 has-checked:-outline-offset-2 has-checked:outline-electric-magenta
                 dark:border-navy dark:bg-gray-900 dark:has-checked:bg-indigo-500/10"
                >
                    <input
                        @click="pickerDateSelected = false"
                        type="radio"
                        :name="dateGroupName"
                        :value="d.value"
                        v-model="selectedDate"
                        class="absolute inset-0 cursor-pointer appearance-none focus:outline-none"
                    />
                    <span class="block text-sm font-semibold text-gray-800 dark:text-white">{{ d.label }}</span>
                    <CheckCircleIcon
                        class="invisible size-5 text-electric-magenta group-has-checked:visible"
                        aria-hidden="true"
                    />
                </label>

                <!-- last card: open calendar -->
                <button
                    type="button"
                    @click="showPicker = true"
                    class="relative flex items-center justify-center rounded-lg border bg-white p-4 text-gray-600
                    dark:border-electric-magenta dark:bg-gray-900 dark:text-gray-400"
                    :class="{
                        'dark:border-electric-magenta': pickerDateSelected,
                        'dark:border': pickerDateSelected,
                        'border-electric-magenta': pickerDateSelected,
                        'border-gray': !pickerDateSelected,
                        'border-2': pickerDateSelected}">
                    <CalendarDaysIcon class="mr-2 size-5" aria-hidden="true" />
                    <span class="text-sm font-semibold text-black dark:text-white">{{ pickerDateSelected ? selectedDate : 'Pilih tanggal lain'}}</span>
                </button>
            </div>
        </fieldset>

        <!-- Modal with VDatePicker -->
        <Dialog :open="showPicker" @close="showPicker = false" class="relative z-50">
            <div class="fixed inset-0 bg-black/40" aria-hidden="true" />
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <DialogPanel
                    class="w-full max-w-md rounded-lg bg-white p-4 shadow-lg ring-1 ring-gray-900/10
                 dark:bg-navy dark:text-white dark:ring-white/10"
                >
                    <h3 class="mb-3 text-sm font-semibold">Pilih tanggal</h3>

                    <VDatePicker v-model="pickerDate" :min-date="minDate" />

                    <div class="mt-4 flex justify-end gap-2">
                        <button type="button" class="rounded-md px-3 py-1.5 text-sm text-gray-600 dark:text-gray"
                                @click="showPicker = false">
                            Batal
                        </button>
                        <button type="button" class="rounded-md bg-gold px-3 py-1.5 text-sm font-semibold text-black hover:brightness-95"
                                @click="applyPicker">
                            Pilih
                        </button>
                    </div>
                </DialogPanel>
            </div>
        </Dialog>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { CheckCircleIcon } from '@heroicons/vue/20/solid'
import { CalendarDaysIcon } from '@heroicons/vue/24/outline'
import { Dialog, DialogPanel } from '@headlessui/vue'

/* --- membership --- */
const membership = [
    { id: 'insidental', title: 'Insidental' },
    { id: 'member', title: 'Member', description: 'Harga lebih murah' },
]
const selectedMembershipId = ref(membership[0].id)

/* --- date helpers --- */
const pad = n => String(n).padStart(2, '0')
const toYMD = d => {
    const x = new Date(d)
    x.setHours(0, 0, 0, 0)
    return `${x.getFullYear()}-${pad(x.getMonth() + 1)}-${pad(x.getDate())}`
}

/* build 3 days: today → +2 (labels in id-ID) */
const days = computed(() => {
    const out = []
    const base = new Date()
    base.setHours(0, 0, 0, 0)
    const fmt = new Intl.DateTimeFormat('id-ID', {
        timeZone: 'Asia/Jakarta',
        weekday: 'short',
        day: '2-digit',
        month: 'short',
    })
    for (let i = 0; i <= 2; i++) {
        const d = new Date(base)
        d.setDate(base.getDate() + i)
        out.push({
            value: toYMD(d),      // stable string for radios
            label: fmt.format(d), // e.g. "Rab, 11 Sep"
        })
    }
    return out
})

/* radio group name (avoid collisions) */
const dateGroupName = `booking-date-${Math.random().toString(36).slice(2)}`

/* selection (default to today) */
const selectedDate = ref(days.value[0].value)

/* modal + picker */
const showPicker = ref(false)
const minDate = days.value[days.value.length-1].value

// block past dates
let pickerDate = ref(new Date(minDate))
pickerDate.value.setDate(pickerDate.value.getDate() + 1)
const pickerDateSelected = ref(false)



function applyPicker() {
    if (pickerDate.value) selectedDate.value = toYMD(pickerDate.value)
    showPicker.value = false
    pickerDateSelected.value = true
}
</script>

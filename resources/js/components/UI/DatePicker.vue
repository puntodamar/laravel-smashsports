<template>
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
                     dark:bg-gray-900 dark:text-gray-400"
                :class="datePickerButtonClass">
                <CalendarDaysIcon class="mr-2 size-5" aria-hidden="true" />
                <span class="text-sm font-semibold text-black dark:text-white">{{ pickerDateSelected ? selectedDate : 'Pilih tanggal lain'}}</span>
            </button>
        </div>
    </fieldset>


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
</template>

<script setup>
import {ref, computed, defineProps} from 'vue'
import { Dialog, DialogPanel } from '@headlessui/vue';
import { CalendarDaysIcon } from '@heroicons/vue/24/outline';
import { CheckCircleIcon } from '@heroicons/vue/20/solid';

const props = defineProps({
    minDate: {type: Date},
})

/* --- date helpers --- */
const pad = n => String(n).padStart(2, '0')
const toYMD = d => {
    const x = new Date(d)
    x.setHours(0, 0, 0, 0)
    return `${x.getFullYear()}-${pad(x.getMonth() + 1)}-${pad(x.getDate())}`
}


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
            value: toYMD(d),
            label: fmt.format(d),
        })
    }
    return out
})


const dateGroupName = `booking-date-${Math.random().toString(36).slice(2)}`
const selectedDate = ref(days.value[0].value)

const showPicker = ref(false)
const minDate = ref(
    props.minDate
        ? new Date(props.minDate)
        : new Date(days.value[days.value.length - 1].value)
)
minDate.value.setDate(minDate.value.getDate() + 1)

// block past dates
const pickerDate = ref(new Date(minDate))
pickerDate.value.setDate(pickerDate.value.getDate() + 1)

const pickerDateSelected = ref(false)


const datePickerButtonClass = computed(() => {

    if (pickerDateSelected.value) {
        return ['dark:border', 'border-electric-magenta', 'border-2']
    } else {
        return ['border-navy']
    }
})



function applyPicker() {
    if (pickerDate.value) selectedDate.value = toYMD(pickerDate.value)
    showPicker.value = false
    pickerDateSelected.value = true
}
</script>

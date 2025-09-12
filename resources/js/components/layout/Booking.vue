<template>
    <div class="flex flex-col items-center">
        <h2 class="font-heading text-3xl font-semibold tracking-tight text-pretty text-black dark:text-white">
            Booking Lapangan
        </h2>


        <form @submit.prevent="" class="text-center">
            <h4 class="text-blue-700 dark:text-white text-sm font-semibold mt-10">Paket</h4>
            <MembershipType></MembershipType>


            <h4 class="text-blue-700 dark:text-white text-sm font-semibold mt-5">Tanggal</h4>
            <DatePicker @update:picker="findAvailableCourt"></DatePicker>

            <div class="relative w-full flex justify-center items-start min-h-[28rem] mt-5">
                <CourtSelectionTab class="m-5" :class="{ 'invisible pointer-events-none select-none': findingInProgress }" />

                <div v-show="findingInProgress"
                     class="absolute inset-0 z-10 flex items-center justify-center bg-white/60 dark:bg-black/40 backdrop-blur-sm">
                    <LoadingSpinner class="mt-5" />
                </div>
            </div>

            <button class="flex gap-x-2 mx-auto rounded-md px-3.5 py-2.5 text-sm font-semibold shadow-xs btn-primary" :class="{hidden: selectedTime === null}">
                <ShoppingCartIcon class="size-5"></ShoppingCartIcon>
                Booking Lapangan
            </button>
        </form>

    </div>
</template>

<script setup>
import DatePicker from '@/components/UI/DatePicker.vue';
import MembershipType from '@/components/UI/booking/MembershipType.vue';
import CourtSelectionTab from '@/components/layout/CourtSelectionTab.vue';
import { ref } from 'vue';
import LoadingSpinner from '@/components/UI/LoadingSpinner.vue';
import { ShoppingCartIcon } from '@heroicons/vue/24/outline'
const findingInProgress = ref(false);

const selectedTime = ref(null)
const selectedMembershipType = ref(null)

const findAvailableCourt = (selectedDate) => {
    findingInProgress.value = true;
    setTimeout(() => {

        findingInProgress.value = false;
    }, 500)
}
</script>

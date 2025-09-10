<template>
    <div class="flex flex-col items-center">
        <h2 class="font-heading text-3xl font-semibold tracking-tight text-pretty text-black dark:text-gold">
            Booking Lapangan
        </h2>

        <h4 class="text-electric-magenta text-sm font-semibold mt-5">Paket</h4>
        <MembershipType></MembershipType>


        <h4 class="text-electric-magenta text-sm font-semibold mt-5">Tanggal</h4>
        <DatePicker></DatePicker>

        <CourtSelectionTab class="m-5 hidden"></CourtSelectionTab>
    </div>
</template>

<script setup>
import DatePicker from '@/components/UI/DatePicker.vue';
import MembershipType from '@/components/UI/booking/MembershipType.vue';
import CourtSelectionTab from '@/components/layout/CourtSelectionTab.vue';
</script>

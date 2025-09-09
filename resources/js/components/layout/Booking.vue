<template>
    <div class="flex flex-col items-center">
        <h2 class="font-heading text-3xl font-semibold tracking-tight text-pretty text-black dark:text-gold">
            Pilih Lapangan
        </h2>

        <!-- Membership -->
        <MembershipType></MembershipType>

        <!-- Dates -->
        <h4 class="text-electric-magenta text-sm font-semibold mt-5">Pilih Tanggal</h4>
        <DatePicker></DatePicker>
    </div>
</template>

<script setup>
import DatePicker from '@/components/UI/DatePicker.vue';
import MembershipType from '@/components/UI/booking/MembershipType.vue';
</script>

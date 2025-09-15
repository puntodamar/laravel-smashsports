<template>
    <Booking class="my-40"></Booking>
</template>

<script setup>
import Booking from '@/components/layout/Booking.vue';
import AppLayout from '@js/Layouts/AppLayout.vue';

defineOptions({
    layout: (h, page) =>
        h(AppLayout, {dynamicHeader: false}, {
            default: () => page,
        }),
})


</script>

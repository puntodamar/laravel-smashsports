<template>
    <AppLayout>
        <template #header>
            <Header></Header>
        </template>
        <Booking class="my-40"></Booking>
    </AppLayout>
</template>

<script setup>
import Booking from '@/components/layout/Booking.vue';
import Header from '@/components/layout/Header.vue';
import Footer from '@/components/layout/Footer.vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@js/Layouts/AppLayout.vue'
</script>

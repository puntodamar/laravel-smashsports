<template>
    <div class="hero min-h-screen relative">
        <div class="relative isolate">
            <div class="absolute top-0 right-0 left-1/2 -z-10 -ml-24 transform-gpu overflow-hidden blur-3xl lg:ml-24 xl:ml-48" aria-hidden="true">
<!--                <div class="aspect-801/1036 w-200.25 bg-linear-to-tr from-electric-magenta to-gold opacity-30" style="clip-path: polygon(63.1% 29.5%, 100% 17.1%, 76.6% 3%, 48.4% 0%, 44.6% 4.7%, 54.5% 25.3%, 59.8% 49%, 55.2% 57.8%, 44.4% 57.2%, 27.8% 47.9%, 35.1% 81.5%, 0% 97.7%, 39.2% 100%, 35.2% 81.4%, 97.2% 52.8%, 63.1% 29.5%)" />-->
            </div>
            <div class="overflow-hidden min-h-screen min-h-[100svh] min-h-[100dvh] flex items-start justify-center">
                <div class="my-auto max-w-7xl px-6 pt-36 pb-32 sm:pt-60 lg:px-8 lg:pt-32">
                    <div class="my-auto max-w-2xl gap-x-14 lg:mx-0 lg:flex lg:max-w-none lg:items-center">
                        <div class="relative w-full lg:max-w-2xl lg:shrink-0 xl:max-w-3xl">
                            <h1 class="font-heading text-5xl font-semibold tracking-tight text-pretty text-gold sm:text-7xl"><i>Your One Stop Badminton Center!</i></h1>
                            <p class="mt-8 text-lg font-medium font-body text-pretty text-white sm:max-w-md sm:text-xl/8 lg:max-w-none ">Nikmati rasanya badminton di lapangan standar BWF, toko olahraga yang lengkap, dan resto yang enak!</p>
                            <div class="mt-10 flex items-center gap-x-6">
                                <Link :href="route('schedule.booking')" class="flex gap-x-2 rounded-md btn-accent px-3.5 py-2.5 text-sm font-semibold shadow-xs bg-gold  text-black ">
                                    <PencilSquareIcon class="size-5"></PencilSquareIcon>
                                    Booking Lapangan
                                </Link>

<!--                                <a :href="route('schedule.booking')"-->
<!--                                   class="flex gap-x-2 rounded-md btn-accent px-3.5 py-2.5 text-sm font-semibold shadow-xs bg-gold  text-black ">-->
<!--                                    <PencilSquareIcon class="size-5"></PencilSquareIcon>-->
<!--                                    Booking Lapangan-->
<!--                                </a>-->

                                <a href="#" class="text-sm/6 font-semibold text-white hover:text-gold flex items-center gap-x-2">
                                    <BuildingStorefrontIcon class="size-5"></BuildingStorefrontIcon>
                                    Toko
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="hero-sentinel" aria-hidden="true" class="h-px w-full"></div>
</template>

<script setup>
import bgMobile from '../../../assets/images/background/bg-hero-mobile.jpg'
import bgDesktop from '../../../assets/images/background/bg-hero-desktop.jpg'
const bgMobileCss  = `url(${bgMobile})`
const bgDesktopCss = `url(${bgDesktop})`
import { PencilSquareIcon, BuildingStorefrontIcon } from '@heroicons/vue/24/outline'
import { route } from 'ziggy-js';
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.hero {
    position: relative;
    isolation: isolate;
}

/* Background only on the pseudo element */
.hero::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: 0;
    background-image: v-bind('bgMobileCss');
    background-size: cover;
    background-position: center top;
    background-repeat: no-repeat;
    filter: brightness(.3);
}

/* Larger screens: switch image + recenter */
@media (min-width: 768px) {
    .hero::before {
        background-image: v-bind('bgDesktopCss');
        background-position: center;
    }
}

/* Respect notches on iOS if the header touches edges*/
:root { --sat: env(safe-area-inset-top); }
.hero { padding-top: max(1rem, var(--sat)); }
</style>

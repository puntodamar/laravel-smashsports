<template>
    <main class="hero min-h-screen">
        <div class="relative isolate">
            <div class="absolute top-0 right-0 left-1/2 -z-10 -ml-24 transform-gpu overflow-hidden blur-3xl lg:ml-24 xl:ml-48" aria-hidden="true">
                <div class="aspect-801/1036 w-200.25 bg-linear-to-tr from-electric-magenta to-gold opacity-30" style="clip-path: polygon(63.1% 29.5%, 100% 17.1%, 76.6% 3%, 48.4% 0%, 44.6% 4.7%, 54.5% 25.3%, 59.8% 49%, 55.2% 57.8%, 44.4% 57.2%, 27.8% 47.9%, 35.1% 81.5%, 0% 97.7%, 39.2% 100%, 35.2% 81.4%, 97.2% 52.8%, 63.1% 29.5%)" />
            </div>
            <div class="overflow-hidden min-h-screen min-h-[100svh] min-h-[100dvh] flex items-start justify-center">
                <div class="my-auto max-w-7xl px-6 pt-36 pb-32 sm:pt-60 lg:px-8 lg:pt-32">
                    <div class="my-auto max-w-2xl gap-x-14 lg:mx-0 lg:flex lg:max-w-none lg:items-center">
                        <div class="relative w-full lg:max-w-2xl lg:shrink-0 xl:max-w-3xl">
                            <h1 class="font-heading text-5xl font-semibold tracking-tight text-pretty text-gold sm:text-7xl"><i>Your One Stop Badminton Center!</i></h1>
                            <p class="mt-8 text-lg font-medium font-body text-pretty text-white sm:max-w-md sm:text-xl/8 lg:max-w-none dark:text-gray">Nikmati rasanya badminton di lapangan standar BWF, toko olahraga yang lengkap, dan resto yang enak!</p>
                            <div class="mt-10 flex items-center gap-x-6">
                                <a href="#"
                                   class="flex gap-x-2 rounded-md btn-accent px-3.5 py-2.5 text-sm font-semibold shadow-xs bg-white  text-black dark:bg-black dark:text-white  hover:bg-gold dark:hover:text-black ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    Booking Lapangan
                                </a>

                                <a href="#" class="text-sm/6 font-semibold text-white hover:text-gold flex items-center gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                    </svg>
                                    Toko
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</template>

<script setup>
import bgMobile from '../../../assets/images/background/bg-hero-mobile.jpg'
import bgDesktop from '../../../assets/images/background/bg-hero-desktop.jpg'
const bgMobileCss  = `url(${bgMobile})`
const bgDesktopCss = `url(${bgDesktop})`
</script>

<style scoped>
.hero {
    position: relative;
    isolation: isolate;             /* contain stacking */
}

/* Background only on the pseudo element */
.hero::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: 0;                     /* keep bg behind content */
    background-image: v-bind('bgMobileCss');
    background-size: cover;
    background-position: center top;/* nicer crop on phones */
    background-repeat: no-repeat;
    filter: brightness(.3);         /* “brightness-50” on image only */
}

/* Larger screens: switch image + recenter */
@media (min-width: 768px) {
    .hero::before {
        background-image: v-bind('bgDesktopCss');
        background-position: center;
    }
}

/* Respect notches on iOS if your header touches edges (optional) */
:root { --sat: env(safe-area-inset-top); }
.hero { padding-top: max(1rem, var(--sat)); }
</style>

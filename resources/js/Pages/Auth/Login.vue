<template>
    <div class="flex h-screen flex-1">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <div class="flex flex-row items-center justify-between">
                        <a :href="route('home')">
                            <img class="h-10 w-auto dark:hidden" :src="companyLogo" alt="logo" />
                            <img class="h-10 w-auto not-dark:hidden" :src='companyLogo' alt="logo" />
                        </a>

                        <PageTheme :bg="'bg-gray-800'" :text="'text-white'"/>
                    </div>
                    <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-black dark:text-white">Masuk ke akun Anda</h2>
                    <p class="mt-2 text-sm/6 text-gray-500 dark:text-gray-400">
                        Belum punya akun?
                        {{ ' ' }}
                        <a href="#" class="font-semibold text-blue-700 dark:text-gold">Daftar</a>
                    </p>

                </div>

                <div class="mt-10">
                    <div>
                        <form action="#" method="POST" class="space-y-6">
                            <div>
                                <label for="email" class="block text-sm/6 font-medium black dark:text-white">Nama</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" autocomplete="name" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm/6 font-medium black dark:text-white">Nomor HP</label>
                                <div class="mt-2">
                                    <input type="text" name="phone" id="phone" autocomplete="phone" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm/6 font-medium black dark:text-white">Alamat email</label>
                                <div class="mt-2">
                                    <input type="email" name="email" id="email" autocomplete="email" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm/6 font-medium text-gray-900 dark:text-gray-100">Password</label>
                                <div class="mt-2">
                                    <input type="password" name="password" id="password" autocomplete="current-password" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex gap-3">
                                    <div class="flex h-6 shrink-0 items-center">
                                        <div class="group grid size-4 grid-cols-1">
                                            <input id="remember-me" name="remember-me" type="checkbox" class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:checked:border-indigo-500 dark:checked:bg-indigo-500 dark:indeterminate:border-indigo-500 dark:indeterminate:bg-indigo-500 dark:focus-visible:outline-indigo-500 forced-colors:appearance-auto" />
                                            <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                                                <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                    <label for="remember-me" class="block text-sm/6 text-gray-900 dark:text-gray-300">Ingatkan saya</label>
                                </div>

                                <div class="text-sm/6">
                                    <a href="#" class="font-semibold text-blue-700 dark:text-gold">Lupa password?</a>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="flex w-full justify-center rounded-md btn-gray">Sign in</button>
                            </div>
                        </form>
                    </div>

                    <div class="mt-10">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-200 dark:border-gray-700" />
                            </div>
                            <div class="relative flex justify-center text-sm/6 font-medium">
                                <span class="px-6 text-gray-900  dark:text-gray-300">Atau login dengan</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <a href="#" class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 focus-visible:inset-ring-transparent dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring-white/5 dark:hover:bg-white/20">
                                <component :is="GoogleIcon" class="size-6 block" aria-hidden="true" />
                                <span class="text-sm/6 font-semibold">Google</span>
                            </a>

                            <a href="#" class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 focus-visible:inset-ring-transparent dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring-white/5 dark:hover:bg-white/20">
                                <component :is="FacebookIconColor" class="size-6 block" aria-hidden="true" />
                                <span class="text-sm/6 font-semibold">GitHub</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block brightness-50">
            <img class="absolute inset-0 size-full object-cover" :src="bgDesktop" alt="" />
        </div>
    </div>
</template>

<script setup>
import bgDesktop from '@assets/images/background/bg-hero-desktop.jpg'
import AppLayout from '@/Layouts/AppLayout.vue';
import { inject } from 'vue';
import PageTheme from '@/components/UI/PageTheme.vue';
import { FacebookIconColor, GoogleIcon } from '@/icons.js';
import { route } from 'ziggy-js';
const companyLogo = inject('companyLogo')

defineOptions({
    layout: (h, page) =>
        h(AppLayout, {header: false, footer: false}, {
            default: () => page,
        }),
})


</script>

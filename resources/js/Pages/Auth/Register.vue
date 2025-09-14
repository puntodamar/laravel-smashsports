<template>
    <AuthLayout :title="title" :mode="mode">
        <template #header>
            <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-black dark:text-white">Sudah punya akun?</h2>
            <p class="mt-2 text-sm/6 text-gray-500 dark:text-gray-400">
                Belum punya akun?
                {{ ' ' }}
                <Link :href="route('login')" class="font-semibold text-blue-700 dark:text-gold" >Login</Link>

            </p>
        </template>

        <template #form>
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

            <div>
                <label for="password" class="block text-sm/6 font-medium text-gray-900 dark:text-gray-100">Password</label>
                <div class="mt-2">
                    <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="current-password" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
                </div>
            </div>
        </template>
    </AuthLayout>
</template>

<script setup>

import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import AppLayout from '@/Layouts/AppLayout.vue';

const title = "Daftar"
const mode = "register"

defineOptions({
    // This keeps AppLayout mounted across Inertia visits,
    // so the Transition inside AppLayout can animate page swaps.
    layout: (h, page) => h(AppLayout, {header: false, footer: false}, { default: () => page }),
})
</script>

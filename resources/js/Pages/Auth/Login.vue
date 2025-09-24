<template>
    <AuthLayout
        :title="title"
        :mode="mode"
        :login-url="route('login.store')"
        :register-url="route('register.store')"
    >
        <template #header>
            <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-black dark:text-white">Masuk ke akun Anda</h2>
            <p class="mt-2 text-sm/6 text-gray-500 dark:text-gray-400">
                Belum punya akun?
                {{ ' ' }}
                <Link :href="route('register')" class="font-semibold text-pocari-blue">Daftar</Link>
            </p>
        </template>

        <template #form="{form}">
            <div>
                <label for="email" class="block text-sm/6 font-medium black dark:text-white">Alamat email</label>
                <div class="mt-2">
                    <input v-model="form.email" type="email" name="email" id="email" autocomplete="email" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-pocari-blue sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 " />
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm/6 font-medium text-gray-900 dark:text-gray-100">Password</label>
                <div class="mt-2">
                    <input v-model="form.password" type="password" name="password" id="password" autocomplete="current-password" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-pocari-blue sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 " />
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex gap-3">
                    <div class="flex h-6 shrink-0 items-center">
                        <div class="group grid size-4 grid-cols-1">
                            <input id="remember-me" name="remember-me" type="checkbox" class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white" />
                            <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                                <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                    <label for="remember-me" class="block text-sm/6 text-gray-900 dark:text-gray-300">Ingatkan saya</label>
                </div>

                <div class="text-sm/6">
                    <a href="#" class="font-semibold text-pocari-blue ">Lupa password?</a>
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

const title = "Masuk"
const mode = "login"

defineOptions({
    layout: (h, page) => h(AppLayout, {header: false, footer: false}, { default: () => page }),
})

</script>

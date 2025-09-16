<template>
    <Head :title="`${appName} | ${props.title}`" />

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

                    <slot name="header"></slot>
                </div>

                <div class="mt-10">
                    <div>
                        <div v-if="errorList.length" class="rounded-md bg-red-50 p-4 dark:bg-red-500/15 dark:outline dark:outline-red-500/25">
                            <div  class="flex">
                                <div class="shrink-0">
                                    <NoSymbolIcon class="size-5 text-red-400" aria-hidden="true" />
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Error!</h3>
                                    <div class="mt-2 text-sm text-red-100 dark:text-red-200/80">
                                        <ul role="list" class="list-disc space-y-1 pl-5">
                                            <li v-for="(error, i) in errorList" :key="i">{{error}}</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form @submit.prevent="submitForm"  class="space-y-6">
                            <div :key="mode">
                                <slot name="form" :form="form" :mode="mode" />
                            </div>
                            <div>
                                <button type="submit" class="flex w-full justify-center rounded-md btn-gray dark:bg-black">{{isLogin ? 'Masuk' : 'Daftar'}}</button>
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
                                <span class="text-sm/6 font-semibold">Facebook</span>
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
import { NoSymbolIcon } from '@heroicons/vue/20/solid'
import bgDesktop from '@assets/images/background/bg-hero-desktop.jpg'
import AppLayout from '@/Layouts/AppLayout.vue';
import { computed, inject, onMounted, reactive } from 'vue';
import PageTheme from '@/components/UI/PageTheme.vue';
import { FacebookIconColor, GoogleIcon } from '@/icons.js';
import { route } from 'ziggy-js';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const isLogin = computed(() => props.mode === 'login')
const appName = computed(() => usePage().props.app.name)
const companyLogo = inject('companyLogo')


const props = defineProps({
    title: {required: false, type: String},
    mode: {required: true, type: String},
    loginUrl: { type: String, default: '/login' },
    registerUrl: { type: String, default: '/register' },
 })


defineOptions({
    // AppLayout persists across Inertia visits, so the Transition can run
    layout: (h, page) => h(AppLayout, {header: false, footer: false}, { default: () => page }),
})

const form = useForm({
    name: null,
    phone: null,
    email: null,
    password: null,
    password_confirmation: null,
})

const state = reactive({ serverErrors: {} })

const errorList = computed(() => {
    if (Array.isArray(props.errors)) return props.errors
    const out = []
    for (const v of Object.values(props.errors || {})) {
        if (Array.isArray(v)) out.push(...v.map(String))
        else if (v) out.push(String(v))
    }
    return out
})

const submitForm = () => {
    state.serverErrors = {}
    const url = isLogin.value ? props.loginUrl : props.registerUrl

    form.post(url, {
        preserveScroll: true,
        onError: (errs) => (state.serverErrors = { ...errs }),
        onSuccess: () => {
            state.serverErrors = {}

        },
    })
}

</script>

<style scoped>
.fade-slide-enter-active, .fade-slide-leave-active { transition: opacity .2s, transform .2s }
.fade-slide-enter-from, .fade-slide-leave-to { opacity: 0; transform: translateY(6px) }
</style>

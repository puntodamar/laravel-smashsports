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
                        <div class="mb-8">
                            <MessageInfoStatus  message="Error!" :error-list="errorList" type="error"/>
                            <MessageInfoStatus :message="messageStatus" type="status"/>
                        </div>
                        <form @submit.prevent="submitForm"  class="space-y-6">
                            <div :key="mode">
                                <slot name="form" :form="form" :mode="mode" />
                            </div>
                            <div>
                                <button type="submit" class="flex w-full justify-center rounded-md btn-gray dark:bg-black hover:cursor-pointer">{{isLogin ? 'Masuk' : 'Daftar'}}</button>
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
import bgDesktop from '@assets/images/background/bg-hero-desktop.jpg'
import AppLayout from '@/Layouts/AppLayout.vue';
import { computed, inject, reactive } from 'vue';
import PageTheme from '@/components/UI/PageTheme.vue';
import { FacebookIconColor, GoogleIcon } from '@/icons.js';
import { route } from 'ziggy-js';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import MessageInfoStatus from '@/components/MessageInfoStatus.vue';

const isLogin = computed(() => props.mode === 'login')
const appName = computed(() => usePage().props.app.name)
const companyLogo = inject('companyLogo')


const props = defineProps({
    title: {required: false, type: String},
    mode: {required: true, type: String},
    loginUrl: { required: true, type: String, default: '/login' },
    registerUrl: {required: true, type: String, default: '/register' },
 })

const page = usePage()
const messageStatus = computed(() => page.props.flash?.status)

defineOptions({
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
    if (Array.isArray(state.serverErrors)) return props.errors
    const out = []
    for (const v of Object.values(props.errors || state.serverErrors || {})) {
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
        onError: (errs) => {
            state.serverErrors = { ...errs }
            console.log(state.serverErrors)
            console.log(errorList)
        },
        onSuccess: () => {
            // Inertia.visit(route('dashboard'), { replace: true }
        },
    })
}

</script>

<style scoped>
.fade-slide-enter-active, .fade-slide-leave-active { transition: opacity .2s, transform .2s }
.fade-slide-enter-from, .fade-slide-leave-to { opacity: 0; transform: translateY(6px) }
</style>

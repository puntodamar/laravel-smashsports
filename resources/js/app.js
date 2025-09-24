// resources/js/app.js
import { createApp, h } from 'vue'
import { createInertiaApp, router } from '@inertiajs/vue3';
import companyLogo from '../assets/images/logo.png'
import VCalendar from 'v-calendar'
import 'v-calendar/style.css'
import { ZiggyVue } from 'ziggy'
import axios from 'axios'
import { createPinia } from 'pinia'
import { useUserStore } from '@store/js/stores/user_store.js';



window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const appPages = import.meta.glob('./Pages/**/*.vue')
const modulePagesUpper    = import.meta.glob('../../Modules/**/Resources/js/Pages/**/*.vue')
const modulePagesLower    = import.meta.glob('../../Modules/**/resources/js/Pages/**/*.vue')
const modulePagesSingular = import.meta.glob('../../Modules/**/resource/js/Pages/**/*.vue')
const pinia = createPinia()

async function load(candidate) {
    const mod = await (typeof candidate === 'function' ? candidate() : candidate)
    return mod.default || mod
}

// module loader
function resolveFromModules(name) {
    if (!name.startsWith('Module/')) return null

    const parts = name.split('/')
    const moduleName = parts[1]
    const rest = parts.slice(2).join('/') || 'Index'

    const candidates = [
        // Capital R
        `../../Modules/${moduleName}/Resources/js/Pages/${rest}.vue`,
        `../../Modules/${moduleName}/Resources/js/Pages/${rest}/Index.vue`,
        // lowercase
        `../../Modules/${moduleName}/resources/js/Pages/${rest}.vue`,
        `../../Modules/${moduleName}/resources/js/Pages/${rest}/Index.vue`,
        // singular
        `../../Modules/${moduleName}/resource/js/Pages/${rest}.vue`,
        `../../Modules/${moduleName}/resource/js/Pages/${rest}/Index.vue`,
    ]

    for (const key of candidates) {
        if (modulePagesUpper[key])    return modulePagesUpper[key]
        if (modulePagesLower[key])    return modulePagesLower[key]
        if (modulePagesSingular[key]) return modulePagesSingular[key]
    }

    console.error('[Inertia] Module page not found:', name, 'Tried:', candidates)
    return null
}

let _appIndex
function normalizePath(p) {
    return p
        .replace(/^\.?\/?Pages\//i, '')
        .replace(/\.vue$/i, '')
        .replace(/\\/g, '/')
        .replace(/\/+/g, '/')
}
function toKeyParts(name) {
    const base = normalizePath(name.replace(/^\/*/, '').replace(/\./g, '/'))
    const parts = new Set([base])
    if (base.endsWith('/Index')) parts.add(base.slice(0, -6))
    return Array.from(parts)
}
function buildAppIndex() {
    if (_appIndex) return _appIndex
    const byExact = new Map()   // "./Pages/Path/To/File.vue" → loader
    const byNorm  = new Map()   // "path/to/file" (lc) → loader (without trailing /Index)

    for (const [key, loader] of Object.entries(appPages)) {
        byExact.set(key, loader)

        const norm = normalizePath(key.replace(/^\.\/?/,'').replace(/^Pages\//, ''))
        const normLC = norm.toLowerCase()
        byNorm.set(normLC, loader)
        if (normLC.endsWith('/index')) {
            byNorm.set(normLC.slice(0, -6), loader) //  map without /index
        }
    }
    _appIndex = { byExact, byNorm }
    return _appIndex
}

async function resolveAppPage(name) {
    const { byExact, byNorm } = buildAppIndex()
    const variants = toKeyParts(name).map(v => v.toLowerCase())

    //exact key
    for (const v of variants) {
        const k1 = `./Pages/${v}.vue`
        const k2 = `./Pages/${v}/Index.vue`
        if (byExact.has(k1)) return load(byExact.get(k1))
        if (byExact.has(k2)) return load(byExact.get(k2))
    }

    // handle variants : Auth.Login or Auth/Login
    for (const v of variants) {
        if (byNorm.has(v)) return load(byNorm.get(v))
    }

    // handle nesting
    for (const [key, loader] of byExact.entries()) {
        const k = key.toLowerCase()
        if (variants.some(v => k.endsWith(`/${v}.vue`) || k.endsWith(`/${v}/index.vue`))) {
            return load(loader)
        }
    }

    return null
}



createInertiaApp({
    // title: 'Smash Sports | Your One Stop Badminton Center',
    resolve: async (name) => {
        // load module first
        const moduleLoader = resolveFromModules(name)
        if (moduleLoader) {
            return load(moduleLoader)
        }

        //fallback to app page
        const page = await resolveAppPage(name)
        if (page) return page

        // missing
        return load(() => import('./Pages/_Missing.vue'))
    },

    // setup({ el, App, props, plugin }) {
    //     const app = createApp({ render: () => h(App, props) })
    //
    //     const pinia = createPinia()
    //     app.use(pinia)
    //     const userStore = useUserStore()
    //
    //     router.on('success', (event) => {
    //         const user = event.detail.page?.props?.auth?.user ?? null
    //         userStore.setUser(user)
    //     })
    //
    //
    //     app.use(plugin)
    //         .use(ZiggyVue)
    //         .use(VCalendar, {
    //                 componentPrefix: 'V',
    //                 locales: { 'id-ID': { firstDayOfWeek: 1 } }, // Senin
    //             })
    //         .provide('companyLogo', companyLogo)
    //         .mount(el);
    //     return app
    // }

    setup: ({ el, App, props, plugin }) =>
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .use(VCalendar, {
                componentPrefix: 'V',
                locales: { 'id-ID': { firstDayOfWeek: 1 } }, // Senin
            })
            .provide('companyLogo', companyLogo)
            .mount(el),
})

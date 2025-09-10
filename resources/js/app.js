import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import companyLogo from '../assets/images/logo.png'
import VCalendar from 'v-calendar'
import 'v-calendar/style.css'
import { ZiggyVue } from 'ziggy'

// App pages
const appPages = import.meta.glob('./Pages/**/*.vue')
// Module pages (support 3 variants)
const modulePagesUpper    = import.meta.glob('../../Modules/**/Resources/js/Pages/**/*.vue')
const modulePagesLower    = import.meta.glob('../../Modules/**/resources/js/Pages/**/*.vue')
const modulePagesSingular = import.meta.glob('../../Modules/**/resource/js/Pages/**/*.vue')

function resolveFromModules(name) {
    if (!name.startsWith('Module/')) return null

    const parts = name.split('/')
    const moduleName = parts[1]
    const rest = parts.slice(2).join('/') || 'Index'

    const candidates = [
        // Capital R (Resources)
        `../../Modules/${moduleName}/Resources/js/Pages/${rest}.vue`,
        `../../Modules/${moduleName}/Resources/js/Pages/${rest}/import { ZiggyVue } from 'ziggy'.vue`,
        // Lowercase (resources)
        `../../Modules/${moduleName}/resources/js/Pages/${rest}.vue`,
        `../../Modules/${moduleName}/resources/js/Pages/${rest}/Index.vue`,
        // Singular (resource)
        `../../Modules/${moduleName}/resource/js/Pages/${rest}.vue`,
        `../../Modules/${moduleName}/resource/js/Pages/${rest}/Index.vue`,
    ]

    for (const key of candidates) {
        if (modulePagesUpper[key])    return modulePagesUpper[key]()
        if (modulePagesLower[key])    return modulePagesLower[key]()
        if (modulePagesSingular[key]) return modulePagesSingular[key]()
    }

    console.error('[Inertia] Module page not found:', name, 'Tried:', candidates)
    return () => import('./Pages/_Missing.vue') // optional fallback
}

createInertiaApp({
    // title: 'Smash Sports | Your One Stop Badminton Center',
    resolve: (name) => {
        const mod = resolveFromModules(name)
        if (mod) return mod

        // fallback to app pages
        const candidates = [`./Pages/${name}.vue`, `./Pages/${name}/Index.vue`]
        for (const key of candidates) if (appPages[key]) return appPages[key]()
        console.error('[Inertia] App page not found:', name)
        return () => import('./Pages/_Missing.vue')
    },
    setup: ({ el, App, props, plugin }) =>
        createApp({ render: () => h(App, props) })
            .use(plugin).use(ZiggyVue)
            .use(VCalendar, {
                componentPrefix: 'V',
                locales: {
                    'id-ID': {
                        firstDayOfWeek: 1,  // Senin
                    },
                },
            })
            .provide('companyLogo', companyLogo)
            .mount(el),
})
console.log('[glob]', Object.keys(modulePagesUpper).length, Object.keys(modulePagesLower).length, Object.keys(modulePagesSingular).length)


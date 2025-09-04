import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

// only this module's pages; no '~' alias needed
const pages = import.meta.glob('./Pages/**/*.vue')

createInertiaApp({
    resolve: (name) => {
        // server sends "Module/Schedule/Index"
        const clean = name.startsWith('Module/Schedule/')
            ? name.slice('Module/Schedule/'.length)
            : name

        // try "Index" and "Index/Index" patterns
        const candidates = [
            `./Pages/${clean}.vue`,
            `./Pages/${clean}/Index.vue`,
        ]

        for (const key of candidates) {
            if (pages[key]) return pages[key]()
        }

        console.error('[Schedule] Page not found:', clean, 'Available:', Object.keys(pages))
        return import('./Pages/_Missing.vue')
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})

// debug so you know this file actually loads
console.log('[Schedule] Vite module entry loaded')

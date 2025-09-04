// resources/js/app.js
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

// 1) Import all page files (both cases)
const modules = import.meta.glob([
    '/resources/js/Pages/**/*.vue',
    '/resources/js/pages/**/*.vue',
    '/Modules/*/Resources/js/Pages/**/*.vue',
    '/Modules/*/Resources/js/pages/**/*.vue',
], { eager: true })

// 2) Build a name -> component map (case-insensitive)
const pageMap = {}
for (const [path, mod] of Object.entries(modules)) {
    // strip common prefixes + extension to get a canonical name like "Schedule/Calendar/Index"
    let name = path
        .replace(/^\/resources\/js\/(Pages|pages)\//, '')
        .replace(/^\/Modules\/[^/]+\/Resources\/js\/(Pages|pages)\//, '')
        .replace(/\.vue$/, '')

    // register multiple keys so resolve() can be flexible
    pageMap[name] = mod
    pageMap[name.toLowerCase()] = mod
    pageMap[name.replaceAll('/', '.')] = mod
    pageMap[name.toLowerCase().replaceAll('/', '.')] = mod
}

createInertiaApp({
    resolve: (name) => pageMap[name] || pageMap[name.toLowerCase()],
    setup: ({ el, App, props, plugin }) => {
        createApp({ render: () => h(App, props) }).use(plugin).mount(el)
    },
})

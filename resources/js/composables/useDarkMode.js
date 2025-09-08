// resources/js/composables/useDarkMode.js
import { ref, onMounted, watch } from 'vue'

const isDark = ref(false)          // <- singleton state (module-scoped)
let initialized = false
let mql // MediaQueryList

function apply(dark) {
    const html = document.documentElement
    if (dark) {
        html.classList.add('dark')
        localStorage.setItem('color-theme', 'dark')
    } else {
        html.classList.remove('dark')
        localStorage.setItem('color-theme', 'light')
    }
}

function handleSystemChange(e) {
    // only follow system if user hasn't set a preference
    if (!('color-theme' in localStorage)) {
        isDark.value = e.matches
    }
}

export function useDarkMode() {
    onMounted(() => {
        if (initialized) return
        initialized = true

        const saved = localStorage.getItem('color-theme') // 'dark' | 'light' | null
        mql = window.matchMedia('(prefers-color-scheme: dark)')
        isDark.value = saved ? saved === 'dark' : mql.matches
        apply(isDark.value)

        // Re-apply whenever isDark changes (button, programmatic, etc.)
        watch(isDark, (v) => {
            console.log('watch', isDark.value)
            apply(v)
        })

        // React to OS theme changes
        if (mql.addEventListener) mql.addEventListener('change', handleSystemChange)
        else if (mql.addListener) mql.addListener(handleSystemChange) // Safari <14
    })

    const toggle   = () => (isDark.value = !isDark.value)   // watcher calls apply()
    const setDark  = () => (isDark.value = true)
    const setLight = () => (isDark.value = false)
    const clearPreference = () => localStorage.removeItem('color-theme')

    return { isDark, toggle, setDark, setLight, clearPreference }
}

import { ref, onMounted, watch } from 'vue'

const isDark = ref(false)
let initialized = false
let mql

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

    if (!('color-theme' in localStorage)) {
        isDark.value = e.matches
    }
}

export function useDarkMode() {
    onMounted(() => {
        if (initialized) return
        initialized = true

        const saved = localStorage.getItem('color-theme') 
        mql = window.matchMedia('(prefers-color-scheme: dark)')
        isDark.value = saved ? saved === 'dark' : mql.matches
        apply(isDark.value)


        watch(isDark, (v) => {
            console.log('watch', isDark.value)
            apply(v)
        })


        if (mql.addEventListener) mql.addEventListener('change', handleSystemChange)
        else if (mql.addListener) mql.addListener(handleSystemChange)
    })

    const toggle   = () => (isDark.value = !isDark.value)
    const setDark  = () => (isDark.value = true)
    const setLight = () => (isDark.value = false)
    const clearPreference = () => localStorage.removeItem('color-theme')

    return { isDark, toggle, setDark, setLight, clearPreference }
}

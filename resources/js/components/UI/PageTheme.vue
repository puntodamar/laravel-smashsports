<template>
    <button @click="onClick" :class="[css, props.bg, props.text]">
        <component :is="isDark ? SunIcon : MoonIcon" class="size-5" aria-hidden="true" />
    </button>
</template>

<script setup>

import { useDarkMode } from '@/composables/useDarkMode.js';
import { useRippleToggle } from '@/composables/useRippleToggle.js';
import { MoonIcon, SunIcon } from '@/icons.js';
const { isDark, toggle } = useDarkMode()

const props = defineProps({
    bg: {type: String, default: 'bg-white dark:bg-black'},
    text: {type: String, default: 'text-black dark:text-white'},
})

const css = 'rounded-lg p-2 dark:bg-black '

const ripple = useRippleToggle({
    getFillColor: () => (!isDark.value ? '#0A1F44' : '#FFFFFF'),
    duration: 550,
    opacity: 0.9,
})

const onClick = (e) => {
    ripple(e, () => {
        toggle()

    })

}
</script>

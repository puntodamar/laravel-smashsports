<template>
    <button @click="onClick" class="rounded-lg bg bg-white text-black p-2">

        <component :is="isDark ? SunIcon : MoonIcon" class="size-5" aria-hidden="true" />
    </button>
</template>

<script setup>

import { useDarkMode } from '@/composables/useDarkMode.js';
import { useRippleToggle } from '@/composables/useRippleToggle.js';
import { MoonIcon, SunIcon } from '@/icons.js';
const { isDark, toggle } = useDarkMode()

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

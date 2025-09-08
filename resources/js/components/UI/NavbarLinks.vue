<!-- NavBarLinks.vue -->
<template>
    <nav
        ref="navRef"
        class="relative isolate hidden lg:flex lg:gap-x-12"
        @mouseleave="hideIndicator"
        @focusin="onFocusIn"
    >
        <!-- sliding BG highlight -->
        <span
            v-show="indicator.visible"
            class="pointer-events-none absolute rounded-md bg-gold z-0
             transition-[transform,width,height,opacity] duration-300 ease-out will-change-transform"
            :style="{
        transform: `translate(${indicator.x}px, ${indicator.y}px)`,
        width: indicator.w + 'px',
        height: indicator.h + 'px',
        opacity: indicator.visible ? 1 : 0
      }"
        />

        <!-- links -->
        <a
            v-for="(item, i) in navigation.main"
            :key="item.name"
            :href="item.href"
            class="relative z-10 inline-flex items-center px-3 py-2 text-sm/6 font-semibold font-body
             transition-colors duration-200
             text-white dark:text-gray"
            :class="{
        'text-black dark:text-gray': hoveredIndex === i, // on top of gold bg
      }"
            @mouseenter="moveIndicator($event.currentTarget, i)"
            @focus="moveIndicator($event.currentTarget, i)"
        >
            {{ item.name }}
        </a>
    </nav>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
    navigation: { type: Object, required: true }, // { main: [{ name, href }, ...] }
})

const navRef = ref(null)
const hoveredIndex = ref(null)
const indicator = ref({ x: 0, y: 0, w: 0, h: 0, visible: false })

function moveIndicator(el, i) {
    if (!navRef.value || !el) return
    const navBox = navRef.value.getBoundingClientRect()
    const box = el.getBoundingClientRect()

    indicator.value = {
        x: box.left - navBox.left,
        y: box.top - navBox.top,
        w: box.width,
        h: box.height,
        visible: true,
    }
    hoveredIndex.value = i
}

function hideIndicator() {
    indicator.value.visible = false
    hoveredIndex.value = null
}

function onFocusIn(e) {
    const link = e.target.closest('a')
    if (link) moveIndicator(link, [...link.parentNode.children].indexOf(link))
}
</script>

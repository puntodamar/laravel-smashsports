<!-- NavBarLinks.vue -->
<template>
    <nav class="relative hidden lg:flex lg:gap-x-12">
        <a
            v-for="item in navigation.main"
            :key="item.name"
            :href="item.href"
            class="group relative inline-flex items-center px-3 py-2 text-sm/6 font-semibold font-body
           text-white transition-colors duration-300 overflow-hidden rounded-md"
        >
            <!-- text flips to black on hover (both modes) -->
            <span class="relative z-10 transition-colors duration-300
                 group-hover:text-black dark:group-hover:text-black">
      {{ item.name }}
    </span>

            <!-- bg slides UP -->
            <span
                class="absolute inset-0 -z-0 bg-gold rounded-md
             origin-bottom scale-y-0 group-hover:scale-y-100
             transition-transform duration-300 ease-out will-change-transform"
            />
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

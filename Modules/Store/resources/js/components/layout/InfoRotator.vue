<template>
  <span
      class="inline-block"
      :style="{ '--dur': duration + 'ms' }"
      aria-live="polite"
      @mouseenter="pauseOnHover && stop()"
      @mouseleave="pauseOnHover && start()"
      @click="delegateClick"
  >
    <Transition name="fade" mode="out-in">
      <span :key="currentKey" v-html="items[current]"></span>
    </Transition>
  </span>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount, watch } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    items: { type: Array, required: true },
    interval: { type: Number, default: 5000 },
    duration: { type: Number, default: 400 },
    pauseOnHover: { type: Boolean, default: true },
})

const current = ref(0)
let timer = null

const tick = () => { current.value = (current.value + 1) % props.items.length }
const start = () => { if (!timer && props.items.length > 1) timer = setInterval(tick, props.interval) }
const stop  = () => { if (timer) { clearInterval(timer); timer = null } }

onMounted(start)
onBeforeUnmount(stop)

watch(() => props.items.length, () => { current.value = 0; stop(); start() })

const currentKey = computed(() => `${current.value}-${props.items[current.value] ?? ''}`)

// intercept link
function delegateClick(e) {
    const link = e.target.closest('a')
    if (!link) return


    if (!link.hasAttribute('data-inertia')) return

    const href = link.getAttribute('href') || ''
    if (!href || href.startsWith('#')) return

    const isExternal = /^https?:\/\//i.test(href) && !href.startsWith(location.origin)
    if (isExternal) return

    e.preventDefault()
    router.visit(href)
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active { transition: opacity var(--dur) ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }
</style>

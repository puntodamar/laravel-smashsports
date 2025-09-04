<template>
    <main style="max-width:840px;margin:48px auto;padding:0 16px;">
        <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 6px 24px rgba(0,0,0,.06);">
            <h1 style="margin:0 0 12px;font-size:28px;">{{ title || 'Schedule' }}</h1>
            <p>Schedule module (Inertia per-module root) is working 🎉</p>
            <p>Route: <code>schedule.index</code> | URL: <code>/schedule</code></p>
        </div>
    </main>
</template>

<script setup>
    defineProps({ title: { type: String, default: 'Schedule' } })
</script>

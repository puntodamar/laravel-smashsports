<template>
    <div ref="container" class="overflow-hidden py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <div class="lg:ml-auto lg:pt-4 lg:pl-4">
                    <div class="lg:max-w-lg">
                        <h2
                            class="text-base/7 font-semibold text-blue-700 transition-all duration-500 ease-out dark:text-gold"
                            :class="started ? 'translate-y-0 opacity-100' : 'translate-y-2 opacity-0'"
                            style="transition-delay: 100ms"
                        >
                            {{ hook }}
                        </h2>

                        <p
                            class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-black transition-all duration-500 ease-out sm:text-5xl dark:text-white"
                            :class="started ? 'translate-y-0 opacity-100' : 'translate-y-2 opacity-0'"
                            style="transition-delay: 250ms"
                        >
                            {{ title }}
                        </p>

                        <p
                            class="mt-6 text-lg/8 text-gray-600 transition-all duration-500 ease-out dark:text-gray-300"
                            :class="started ? 'translate-y-0 opacity-100' : 'translate-y-2 opacity-0'"
                            style="transition-delay: 400ms"
                        >
                            {{ description }}
                        </p>

                        <div class="mt-10 max-w-xl space-y-8 text-base/7 text-gray-600 lg:max-w-none dark:text-gray-400">
                            <div
                                v-for="(feature, i) in props.features"
                                :key="feature.name"
                                class="relative pl-9 transition-all duration-500 ease-out [will-change:transform,opacity]"
                                :class="started ? '-translate-x-0 opacity-100' : '-translate-x-10 opacity-0'"
                                :style="{ transitionDelay: `${(i + 1) * 500}ms` }"
                            >
                                <dt class="inline font-semibold text-gray-900 dark:text-white">
                                    <component
                                        :is="feature.icon"
                                        class="absolute top-1 left-1 size-5 text-blue-700 dark:text-gold"
                                        aria-hidden="true"
                                    />
                                    {{ feature.name }}
                                </dt>
                                <span aria-hidden="true">&nbsp;</span>
                                <dd class="inline">{{ feature.description }}</dd>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-start" :class="featureClass()">
                    <div
                        class="inline-block transform-gpu transition-all duration-[1000ms] ease-out will-change-transform"
                        :class="started ? 'translate-x-0 opacity-100' : props.imagePosition === 'left' ? '-translate-x-8 opacity-0' : 'translate-x-8 opacity-0'"
                        style="transition-delay: 1000ms"
                    >
                        <img
                            :src="props.image"
                            :alt="props.title"
                            class="sm:h-sm block h-80 w-xl max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-228 md:h-auto dark:ring-white/10"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, defineProps } from 'vue';

const props = defineProps({
    hook: { type: String, required: true },
    title: { type: String, required: true },
    description: { type: String, required: true },
    image: { type: String, required: true },
    imagePosition: { type: String, default: 'right' },
    features: { type: Array, required: true },
    threshold: { type: Number, default: 0.1 },
    once: { type: Boolean, default: true },
});

const container = ref(null);
const started = ref(false);
let observer = null;

const featureClass = () => (props.imagePosition === 'left' ? ['justify-end', 'lg:order-first'] : ['justify-start']);

onMounted(() => {
    observer = new IntersectionObserver(
        (entries) => {
            for (const entry of entries) {
                if (entry.isIntersecting) {
                    started.value = true
                    if (props.once) observer.unobserve(entry.target)
                } else if (!props.once) {
                    started.value = false
                }
            }
        },
        {
            root: null,
            threshold: props.threshold,
            rootMargin: '0px 0px -20% 0px',
        }
    )
    if (container.value) observer.observe(container.value)
})

onBeforeUnmount(() => observer && observer.disconnect())
</script>

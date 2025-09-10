<template>
    <div class="overflow-hidden py-24 sm:py-32 ">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <div class="lg:ml-auto lg:pt-4 lg:pl-4">
                    <div class="lg:max-w-lg">
                        <h2 class="text-base/7 font-semibold text-electric-magenta ">{{hook}}</h2>
                        <p class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-black sm:text-5xl dark:text-gold">{{title}}</p>
                        <p class="mt-6 text-lg/8 text-gray-600 dark:text-gray-300">{{description}}</p>
                        <dl class="mt-10 max-w-xl space-y-8 text-base/7 text-gray-600 lg:max-w-none dark:text-gray-400">
                            <div v-for="feature in props.features" :key="feature.name" class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900 dark:text-white">
                                    <component :is="feature.icon" class="absolute top-1 left-1 size-5 text-electric-magenta " aria-hidden="true" />
                                    {{ feature.name }}
                                </dt>
                                {{ ' ' }}
                                <dd class="inline">{{ feature.description }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="flex items-start" :class="featureClass()">
                    <img :src="props.image" :alt="props.title" class="w-xl max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-228 dark:ring-white/10 h-80 sm:h-sm md:h-auto" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    hook: {required: true, type: String},
    title: {required: true, type: String},
    description: {required: true, type: String},
    image: {required: true, type: String},
    imagePosition: {required: false, type: String, default: "right"},
    features: {required: true, type: Array}
})

const featureClass = () => {
    if(props.imagePosition === 'left') {
        return ['justify-end', 'lg:order-first']
    } else {
        return ['justify-start']
    }
}

</script>

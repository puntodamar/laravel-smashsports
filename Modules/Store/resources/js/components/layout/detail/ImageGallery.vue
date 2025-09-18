<template>
    <!-- Mobile: swiper carousel -->
    <div class="sm:hidden" aria-roledescription="carousel">
        <Swiper
            class="relative [--swiper-theme-color:var(--color-navy)] [--swiper-navigation-color:var(--color-navy)] [--swiper-pagination-color:var(--color-navy)]"
            :modules="swiperModules"
            :slides-per-view="1"
            :space-between="0"
            :loop="false"
            :pagination="{ clickable: true }"
            :navigation="false"
        >
            <SwiperSlide
                v-for="(image, i) in images"
                :key="image.id ?? i"
                :aria-label="`Slide ${i + 1} of ${images.length}`"
            >
                <img
                    :src="image.src"
                    :alt="image.alt || image.name || ''"
                    class="aspect-square w-full object-contain bg-white"
                    loading="lazy"
                    decoding="async"
                />
            </SwiperSlide>
        </Swiper>
    </div>

    <div class="hidden sm:block">
        <TabGroup as="div" class="flex flex-col-reverse">
            <div class="mx-auto mt-6 w-full max-w-2xl lg:max-w-none">
                <TabList class="grid grid-cols-4 gap-6">
                    <Tab
                        v-for="(image, i) in images"
                        :key="image.id ?? i"
                        class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm font-medium text-gray-900 uppercase hover:bg-yellow-300 focus:outline-none focus:ring-2"
                        v-slot="{ selected }"
                    >
                        <span class="sr-only">{{ image.name || image.alt || `Image ${i+1}` }}</span>
                        <span class="absolute inset-0 overflow-hidden rounded-md">
              <img :src="image.src" :alt="image.alt || image.name || ''" class="h-full w-full object-cover" loading="lazy" />
            </span>
                        <span :class="[selected ? 'ring-blue-900 dark:ring-yellow-300' : 'ring-transparent', 'pointer-events-none absolute inset-0 rounded-md ring-2 ring-offset-2']" aria-hidden="true" />
                    </Tab>
                </TabList>
            </div>

            <TabPanels>
                <TabPanel v-for="(image, i) in props.images" :key="image.id ?? i">
                    <img :src="image.src" :alt="image.alt || image.name || ''" class="aspect-square w-full object-contain sm:rounded-lg bg-white" />
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>

<script setup>
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Pagination, Navigation, A11y } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/pagination'
import 'swiper/css/navigation'

const props = defineProps({
    images: { type: Array, default: () => [] },
})

const swiperModules = [Pagination, Navigation, A11y]

</script>



<template>
    <div class="space-y-2 mb-6">
        <div v-for="(category, i) in navigation.categories" :key="category.name" class="group rounded-lg">
            <div
                class="mx-2 flex cursor-pointer items-center justify-between rounded-lg px-2 select-none group-hover:bg-gold"
                role="button"
                :aria-expanded="isOpen(i)"
                :aria-controls="`panel-${i}`"
                @click="onHeaderClick($event, i, category)"
            >
                <Link
                    :href="category.href ?? '#'"
                    class="flex flex-row items-center gap-x-2 w-full rounded-lg py-2 text-left text-base/7 font-semibold text-black group-hover:text-black dark:text-gray-200 dark:group-hover:text-black"
                >
                    <component :is="category.icon" class="size-5"></component>
                    {{ category.name }}
                </Link>

                <svg
                    v-if="hasChildren(category)"
                    class="size-5 text-navy transition-transform dark:text-gray-300 dark:group-hover:text-navy"
                    :class="isOpen(i) ? 'rotate-180' : ''"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    aria-hidden="true"
                >
                    <path
                        fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.104l3.71-3.874a.75.75 0 111.08 1.04l-4.24 4.43a.75.75 0 01-1.08 0l-4.24-4.43a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd"
                    />
                </svg>
            </div>

            <Transition name="acc">
                <div v-show="isOpen(i)" :id="`panel-${i}`" class="px-4 pb-2">
                    <div v-if="category?.collection?.length" class="mt-2 pl-4">
                        <p class="pl-4 text-xs font-light dark:text-gray underline">Koleksi</p>
                        <ul class="mt-1 space-y-1">
                            <li v-for="(item, idx) in category.collection" :key="`collection-${idx}`" class="pl-4">
                                <Link :href="item.href" class="text-sm font-light text-gray-900 dark:text-gray-200">
                                    {{ item.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <div v-if="category?.brands?.length" class="mt-8 pl-4">
                        <p class="pl-4 text-xs font-light dark:text-gray underline">Merk</p>
                        <ul class="mt-1 space-y-1">
                            <li v-for="(brand, b) in category.brands" :key="`brand-${b}`" class="pl-4">
                                <Link :href="brand.href" class="text-sm font-light text-gray-900 dark:text-gray-200">
                                    {{ brand.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <div v-if="category?.categories?.length" class="mt-8 pl-4">
                        <p class="pl-4 text-xs font-light dark:text-gray underline">Sub Kategori</p>
                        <ul class="mt-1 space-y-1">
                            <li v-for="(sub, s) in category.categories" :key="`sub-${s}`" class="pl-4">
                                <Link :href="sub.href" class="text-sm font-light text-gray-900 dark:text-gray-200">
                                    {{ sub.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </Transition>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    navigation: { type: Object, required: true },
});

const open = ref(new Set());

function toggle(i) {
    if (open.value.has(i)) open.value.delete(i);
    else open.value.add(i);
    open.value = new Set(open.value); // force reactivity
}

function isOpen(i) {
    return open.value.has(i);
}

function hasChildren(cat) {
    return !!((cat?.collection && cat.collection.length) || (cat?.brands && cat.brands.length) || (cat?.categories && cat.categories.length));
}


function onHeaderClick(e, i, category) {
    if (!hasChildren(category)) return;
    e.preventDefault();
    toggle(i);
}
</script>

<style scoped>
.acc-enter-active,
.acc-leave-active {
    transition: all 200ms ease;
}

.acc-enter-from,
.acc-leave-to {
    max-height: 0;
    opacity: 0;
}

.acc-enter-to,
.acc-leave-from {
    max-height: 500px;
    opacity: 1;
}
</style>

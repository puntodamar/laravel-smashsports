<template>
    <fieldset>
        <div class="mt-6 grid grid-cols-2 gap-x-4 px-5">
            <label
                v-for="m in membership"
                :key="m.id"
                :aria-label="m.title"
                class="group relative flex rounded-lg border border-gray bg-white p-4
                 has-checked:outline-2 has-checked:-outline-offset-2 has-checked:outline-pocari-blue
                 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1
                 has-disabled:border-gray has-disabled:bg-gray has-disabled:opacity-25
                 dark:border-navy dark:bg-gray-900 dark:has-checked:bg-indigo-500/10">
                <input
                    type="radio"
                    name="membership"
                    :value="m.id"
                    v-model="selectedMembershipId"
                    class="absolute inset-0 appearance-none focus:outline-none cursor-pointer"
                />
                <div class="flex-1">
                    <span class="block text-sm font-medium text-gray-800 dark:text-gray">{{ m.title }}</span>
                    <span v-if="m.description" class="mt-1 block text-xs text-gray-500 dark:text-gray-400">{{ m.description }}</span>
                </div>
                <CheckCircleIcon
                    class="invisible size-5 group-has-checked:visible text-pocari-blue"
                    aria-hidden="true"
                />
            </label>
        </div>
    </fieldset>
</template>

<script setup>
import { CheckCircleIcon } from '@heroicons/vue/20/solid';
import { ref } from 'vue';
const membership = [
    { id: 'insidental', title: 'Insidental', description: 'Sekali main' },
    { id: 'member', title: 'Member', description: 'Harga lebih murah' },
]
const selectedMembershipId = ref(membership[0].id)

</script>

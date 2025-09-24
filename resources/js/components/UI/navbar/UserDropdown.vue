<template>

    <Menu as="div" class="relative flex flex-row hover:cursor-pointer">
        <MenuButton class="flex items-center rounded-full  hover:cursor-pointer">
            <span class="text-sm/6 font-semibold">{{props.username}}</span>
            <span class="sr-only">{{props.username}}</span>
            <UserIcon class="size-5 ml-2" aria-hidden="true" />
        </MenuButton>

        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems
                class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg outline-1 outline-gray dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-gray/10">
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <a href="#" :class="[active ? 'bg-gray-100 text-gray-900 outline-hidden dark:bg-white/5 dark:text-white' : 'text-gray-700 dark:text-gray-300', 'block px-4 py-2 text-sm']">Account settings</a>
                    </MenuItem>
                    <form @submit.prevent="logout">
                        <MenuItem v-slot="{ active }" class="hover:cursor-pointer">
                            <button type="submit" :class="[active ? 'bg-gray-100 text-gray-700 outline-hidden dark:bg-white/5 dark:text-white' : 'text-gray-700 dark:text-gray-300', 'block w-full px-4 py-2 text-left text-sm']">Logout</button>
                        </MenuItem>
                    </form>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script setup>
    import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
    import { useForm } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';
    import {UserIcon} from '@heroicons/vue/24/outline';

    const props = defineProps({
        username: {type: String, required: true},

    })

    const logout = () => {
        const form = useForm()
        form.post(route('logout'))
    }
</script>

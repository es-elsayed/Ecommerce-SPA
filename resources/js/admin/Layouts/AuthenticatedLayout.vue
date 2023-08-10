<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/admin/Components/ApplicationLogo.vue';
import Dropdown from '@/admin/Components/Dropdown.vue';
import DropdownLink from '@/admin/Components/DropdownLink.vue';
import NavLinks from '@/admin/Components/Nav/NavLinks.vue';
import ResponsiveNavLinks from '@/admin/Components/Nav/ResponsiveNavLinks.vue';
import { Link } from '@inertiajs/vue3';
import Alert from '@/admin/Components/Alert.vue';
import DropdownButton from '@/admin/Components/DropdownButton.vue';

const showingNavigationDropdown = ref(false);
defineProps({
    title: {
        type: String,
        default: "",
        required: false
    }
})
</script>

<template>
    <div>
        <Alert />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex items-center shrink-0">
                                <Link :href="route('admin.dashboard')">
                                <ApplicationLogo class="block w-auto text-gray-800 fill-current h-9" />
                                </Link>
                            </div>

                            <NavLinks />
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="relative ml-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <DropdownButton :label="$page.props.auth.user.name"
                                            :active="route().current('profile.edit')" />
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="flex items-center -mr-2 sm:hidden">
                            <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <ResponsiveNavLinks :showNavigation="showingNavigationDropdown" />

            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="flex justify-between px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <h2 v-if="title" class="text-xl font-semibold leading-tight text-gray-800">
                        {{ title }}
                    </h2>
                    <div class="flex justiry-between" v-if="$slots.actions">

                        <slot name="actions" />
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="py-12">
                <slot />
            </main>
        </div>
    </div>
</template>

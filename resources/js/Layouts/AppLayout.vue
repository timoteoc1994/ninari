<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import Banner from "@/Components/Banner.vue";
import Sidebar from "@/Components/Sidebar.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";

defineProps({
    title: String,
});

const isMobileMenuOpen = ref(false);
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-gray-100 dark:bg-gray-900">
        <Head :title="title" />

        <!-- Sidebar -->
        <Sidebar
            :is-open="isMobileMenuOpen"
            @close="isMobileMenuOpen = false"
        />

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            <Banner />

            <!-- Mobile Header -->
            <div
                class="lg:hidden bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 p-4 flex items-center justify-between"
            >
                <!-- Logo -->
                <Link :href="route('dashboard')">
                    <ApplicationMark class="block h-8 w-auto" />
                </Link>

                <!-- Hamburger Button -->
                <button
                    @click="isMobileMenuOpen = !isMobileMenuOpen"
                    class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 transition duration-150 ease-in-out"
                >
                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>
            </div>

            <!-- Page Heading -->
            <header
                v-if="$slots.header"
                class="bg-white dark:bg-gray-800 shadow z-10"
            >
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";

const props = defineProps({
    active: String,
    isOpen: Boolean, // Control visibility on mobile
});

const emit = defineEmits(["close"]);

const logout = () => {
    router.post(route("logout"));
};

const menuItems = [
    {
        name: "Dashboard",
        route: "dashboard",
        icon: "M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6",
    },
    {
        name: "Profile",
        route: "profile.show",
        icon: "M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z",
    },
];

// Helper to check if route is active
const isRouteActive = (routeName) => {
    return route().current(routeName);
};
</script>

<template>
    <!-- Mobile Backdrop -->
    <div
        v-if="isOpen"
        class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden"
        @click="$emit('close')"
    ></div>

    <aside
        class="fixed inset-y-0 left-0 z-50 flex flex-col w-20 h-screen bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 transition-transform duration-300 lg:translate-x-0 lg:static lg:flex"
        :class="isOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        <!-- Logo -->
        <div
            class="h-20 flex items-center justify-center border-b border-gray-100 dark:border-gray-800 relative"
        >
            <Link :href="route('dashboard')">
                <ApplicationMark class="block h-8 w-auto" />
            </Link>
            <!-- Close Button (Mobile Only) -->
            <button
                @click="$emit('close')"
                class="absolute top-2 right-2 p-1 text-gray-400 hover:text-gray-600 lg:hidden"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </button>
        </div>

        <!-- Navigation Items -->
        <nav
            class="flex-1 flex flex-col gap-4 py-8 items-center overflow-y-auto no-scrollbar"
        >
            <div
                v-for="item in menuItems"
                :key="item.name"
                class="relative group"
            >
                <Link
                    :href="route(item.route)"
                    class="relative flex items-center justify-center w-12 h-12 rounded-xl transition-all duration-300 group-hover:bg-indigo-50 dark:group-hover:bg-indigo-900/20"
                    :class="{
                        'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400':
                            isRouteActive(item.route),
                        'text-gray-500 dark:text-gray-400': !isRouteActive(
                            item.route
                        ),
                    }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 transition-transform duration-300 group-hover:scale-110"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            :d="item.icon"
                        />
                    </svg>
                </Link>

                <!-- 3D Glass Tooltip -->
                <div
                    class="absolute left-14 top-1/2 -translate-y-1/2 ml-4 opacity-0 group-hover:opacity-100 pointer-events-none transition-all duration-300 transform translate-x-[-10px] group-hover:translate-x-0 z-50 hidden lg:block"
                >
                    <div
                        class="relative bg-gray-900/80 backdrop-blur-md text-white px-4 py-2 rounded-lg shadow-xl border border-white/10 whitespace-nowrap"
                    >
                        <!-- Arrow -->
                        <div
                            class="absolute left-0 top-1/2 -translate-x-1 -translate-y-1/2 border-t-4 border-b-4 border-r-4 border-transparent border-r-gray-900/80"
                        ></div>
                        <span class="font-medium tracking-wide">{{
                            item.name
                        }}</span>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Bottom Actions -->
        <div
            class="pb-8 flex flex-col items-center gap-4 border-t border-gray-100 dark:border-gray-800 pt-6"
        >
            <!-- Logout -->
            <div class="relative group">
                <form @submit.prevent="logout">
                    <button
                        type="submit"
                        class="relative flex items-center justify-center w-12 h-12 rounded-xl text-gray-500 dark:text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-300"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 transition-transform duration-300 group-hover:scale-110"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                            />
                        </svg>
                    </button>
                </form>

                <!-- Tooltip for Logout -->
                <div
                    class="absolute left-14 top-1/2 -translate-y-1/2 ml-4 opacity-0 group-hover:opacity-100 pointer-events-none transition-all duration-300 transform translate-x-[-10px] group-hover:translate-x-0 z-50 hidden lg:block"
                >
                    <div
                        class="relative bg-red-900/80 backdrop-blur-md text-white px-4 py-2 rounded-lg shadow-xl border border-white/10 whitespace-nowrap"
                    >
                        <div
                            class="absolute left-0 top-1/2 -translate-x-1 -translate-y-1/2 border-t-4 border-b-4 border-r-4 border-transparent border-r-red-900/80"
                        ></div>
                        <span class="font-medium tracking-wide">Log Out</span>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>

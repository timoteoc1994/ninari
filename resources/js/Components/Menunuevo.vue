<script setup>
import { Link } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const menuOpen = ref(false);

const toggleMenu = () => {
    menuOpen.value = !menuOpen.value;
};
const logoblanco= "/storage/webninari2/logoblanco.png";
</script>

<template>
    <!-- Delete Account Confirmation Modal -->

    <div class="relative grid grid-cols-12 p-6 z-[100]">
        <!-- Logo -->
        <div class="col-span-3 flex justify-center">
            <Link :href="route('welcome')">
                <img
                    :src="logoblanco"
                    class="transition-transform duration-300 ease-in-out hover:scale-110"
                    alt="Logo"
                    width="200px"
                />
            </Link>
        </div>

        <!-- Menú en pantallas grandes -->
        <div class="col-span-7 justify-center hidden lg:flex items-center">
            <nav>
                <ul class="flex gap-4">
                    <li>
                        <Link
                            :href="route('welcome')"
                            class="text-lg px-3 py-1 inline-block text-white"
                            :class="{
                                'txt-colo-menu': !route().current('welcome'), // color por defecto
                                'border-b-2 border-white':
                                    route().current('welcome'), // raya blanca abajo cuando está activo
                            }"
                        >
                            Inicio
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('nosotros2')"
                            class="text-lg px-3 py-1 inline-block text-white"
                            :class="{
                                'txt-colo-menu': !route().current('nosotros2'), // color por defecto
                                'border-b-2 border-white':
                                    route().current('nosotros2'), // raya blanca abajo cuando está activo
                            }"
                        >
                            Nosotros
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('ecosistema2')"
                            class="text-lg px-3 py-1 inline-block text-white"
                            :class="{
                                'txt-colo-menu': !route().current('ecosistema2'), // color por defecto
                                'border-b-2 border-white':
                                    route().current('ecosistema2'), // raya blanca abajo cuando está activo
                            }"
                        >
                            Ecosistema
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('programas2')"
                            class="text-lg px-3 py-1 inline-block text-white"
                            :class="{
                                'txt-colo-menu': !route().current('programas2'), // color por defecto
                                'border-b-2 border-white':
                                    route().current('programas2'), // raya blanca abajo cuando está activo
                            }"
                        >
                            Programas
                        </Link>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/company/ninari-foundation/posts/?feedView=all" target="_blank"  class="text-lg px-3 py-1 inline-block text-white">Noticias</a>
                    </li>
                    <li>
                        <Link
                            :href="route('contacto2')"
                            class="text-lg px-3 py-1 inline-block text-white"
                            :class="{
                                'txt-colo-menu': !route().current('contacto2'), // color por defecto
                                'border-b-2 border-white':
                                    route().current('contacto2'), // raya blanca abajo cuando está activo
                            }"
                        >
                            Contacto
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- botón sesión (solo desktop) -->
        <div class="col-span-2 hidden lg:flex items-center justify-end">
            <a href="https://portal.ninari.org/login" class="btn-impulsamos lg:mb-0">
                Iniciar Sesión
            </a>
        </div>

        <!-- Botón de menú hamburguesa (solo en móviles) -->
        <div class="col-span-9 flex justify-end items-center lg:hidden">
            <button
                @click="toggleMenu"
                class="text-white focus:outline-none"
            >
                <svg
                    v-if="!menuOpen"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7"
                    />
                </svg>
                <svg
                    v-else
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>
    </div>

    <!-- Menú desplegable en móviles -->
    <div
        v-if="menuOpen"
        class="lg:hidden fixed top-20 left-0 w-full bg-white shadow-lg z-[9999]"
    >
        <nav>
            <ul class="flex flex-col gap-3 p-5">
                <li>
                    <Link
                        :href="route('welcome')"
                        @click="toggleMenu"
                        class="block text-lg p-3 hover:bg-gray-200 rounded-md"
                        :class="{
                            'bg-purple-100 font-bold': route().current('welcome')
                        }"
                        >Inicio</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('nosotros2')"
                        @click="toggleMenu"
                        class="block text-lg p-3 hover:bg-gray-200 rounded-md"
                        :class="{
                            'bg-purple-100 font-bold': route().current('nosotros2')
                        }"
                        >Nosotros</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('ecosistema2')"
                        @click="toggleMenu"
                        class="block text-lg p-3 hover:bg-gray-200 rounded-md"
                        :class="{
                            'bg-purple-100 font-bold': route().current('ecosistema2')
                        }"
                        >Ecosistema</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('programas2')"
                        @click="toggleMenu"
                        class="block text-lg p-3 hover:bg-gray-200 rounded-md"
                        :class="{
                            'bg-purple-100 font-bold': route().current('programas2')
                        }"
                        >Programas</Link
                    >
                </li>
                <li>
                    <a
                        href="https://www.linkedin.com/company/ninari-foundation/posts/?feedView=all"
                        target="_blank"
                        class="block text-lg p-3 hover:bg-gray-200 rounded-md"
                        >Noticias</a
                    >
                </li>
                <li>
                    <Link
                        :href="route('contacto2')"
                        @click="toggleMenu"
                        class="block text-lg p-3 hover:bg-gray-200 rounded-md"
                        :class="{
                            'bg-purple-100 font-bold': route().current('contacto2')
                        }"
                        >Contacto</Link
                    >
                </li>
                <li>
                    <a
                        href="https://portal.ninari.org/login"
                        class="block text-lg p-3 bg-purple-600 text-white text-center rounded-md hover:bg-purple-700 transition-all"
                        >Iniciar Sesión</a
                    >
                </li>
            </ul>
        </nav>
    </div>
</template>
<style scoped>
/* Botón impulsamos */
.btn-impulsamos {
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.8);
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 20px;
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.btn-impulsamos:hover {
    background: rgba(255, 255, 255, 0.15);
    border-color: white;
}
</style>

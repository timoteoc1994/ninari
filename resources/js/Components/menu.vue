<script setup>
import { Link } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const imageUrl = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/logo.png`
);

const menuOpen = ref(false);

const toggleMenu = () => {
    menuOpen.value = !menuOpen.value;
};
</script>

<template>
    <!-- Delete Account Confirmation Modal -->
    <!-- Donation Modal -->
    <dialog
        ref="modal"
        class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden"
    >
        <div class="relative">
            <!-- Decorative elements -->
            <div
                class="absolute -left-16 -top-16 h-48 w-48 rounded-full bg-gradient-to-br from-rose-400 to-purple-500 opacity-20"
            ></div>
            <div
                class="absolute -bottom-16 -right-16 h-48 w-48 rounded-full bg-gradient-to-br from-amber-400 to-rose-500 opacity-20"
            ></div>

            <!-- Close button -->
            <button
                @click="$refs.modal.close()"
                class="absolute right-4 top-4 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-gray-500"
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

            <!-- Modal Header -->
            <div class="pt-8 pb-4 px-6">
                <div class="mb-4 flex justify-center">
                    <div
                        class="rounded-full bg-gradient-to-r from-rose-500 to-purple-600 p-3"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                            />
                        </svg>
                    </div>
                </div>
                <h2
                    class="text-2xl font-bold text-center text-gray-900 dark:text-white"
                >
                    Apoya Nuestra Misión
                </h2>
            </div>

            <!-- Persuasive message -->
            <div
                class="px-6 py-4 bg-gradient-to-r from-rose-50 to-purple-50 dark:from-rose-900/20 dark:to-purple-900/20 border-y border-gray-100 dark:border-gray-700"
            >
                <p class="text-center italic text-gray-700 dark:text-gray-300">
                    "Cada donación es una semilla de esperanza. Con tu apoyo,
                    podemos identificar y conectar a los actores del ecosistema
                    de innovación para impulsar el desarrollo socioeconómico
                    sostenible en Ecuador y la región andina; utilizando la
                    innovación social, productiva y comercial, resolvemos
                    problemas y potenciamos oportunidades, catalizamos el cambio
                    creando regiones más inclusivas, competitivas y
                    sostenibles."
                </p>
            </div>

            <!-- Foundation information -->
            <div class="p-6 space-y-4">
                <h3 class="font-semibold text-lg text-gray-900 dark:text-white">
                    Información de la Fundación
                </h3>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400"
                            >RUC:</span
                        >
                        <span class="font-medium text-gray-900 dark:text-white"
                            >1891811724001</span
                        >
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400"
                            >Dirección:</span
                        >
                        <span class="font-medium text-gray-900 dark:text-white"
                            >Av. Juan Montalvo y Simón Bolivar, Ambato</span
                        >
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400"
                            >Correo:</span
                        >
                        <span class="font-medium text-gray-900 dark:text-white"
                            >info@ninari.org</span
                        >
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="p-6 bg-gray-50 dark:bg-gray-800/50">
                <p
                    class="text-center text-xs text-gray-500 dark:text-gray-400 mt-4"
                >
                    Tu donación es segura y ayuda a continuar nuestra labor.
                    ¡Gracias por tu apoyo!
                </p>
            </div>
        </div>
    </dialog>
    <div
        class="relative grid grid-cols-12 mt-6 mb-6 bg-white bg-opacity-40 p-6"
    >
        <!-- Logo -->
        <div class="col-span-3 flex justify-center">
            <Link :href="route('welcome')">
                <img
                    :src="imageUrl"
                    class="transition-transform duration-300 ease-in-out hover:scale-110"
                    alt="Logo"
                    width="250px"
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
                            class="text-lg hover:bg-white p-3 rounded-md"
                            :class="{
                                'txt-colo-menu': !route().current('welcome'), // color por defecto
                                'txt-anaranjado-fuerte':
                                    route().current('welcome'), // color cuando está activo
                                'bg-white font-bold':
                                    route().current('welcome'), // estilos adicionales cuando está activo
                            }"
                        >
                            INICIO
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('nosotros')"
                            class="text-lg hover:bg-white p-3 rounded-md"
                            :class="{
                                'txt-colo-menu': !route().current('nosotros'), // color por defecto
                                'txt-anaranjado-fuerte':
                                    route().current('nosotros'), // color cuando está activo
                                'bg-white font-bold':
                                    route().current('nosotros'), // estilos adicionales cuando está activo
                            }"
                        >
                            NOSOTROS
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('ecosistema')"
                            class="text-lg hover:bg-white p-3 rounded-md"
                            :class="{
                                'txt-colo-menu': !route().current('ecosistema'), // color por defecto
                                'txt-anaranjado-fuerte':
                                    route().current('ecosistema'), // color cuando está activo
                                'bg-white font-bold':
                                    route().current('ecosistema'), // estilos adicionales cuando está activo
                            }"
                        >
                            ECOSISTEMA NINARI
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('programas')"
                            class="text-lg hover:bg-white p-3 rounded-md"
                            :class="{
                                'txt-colo-menu': !route().current('programas'), // color por defecto
                                'txt-anaranjado-fuerte':
                                    route().current('programas'), // color cuando está activo
                                'bg-white font-bold':
                                    route().current('programas'), // estilos adicionales cuando está activo
                            }"
                        >
                            PROGRAMAS
                        </Link>
                    </li>
                    <li>
                        <a
                            href="https://www.instagram.com/ninarifoundation"
                            target="_blank"
                            class="txt-colo-menu text-lg hover:bg-white p-3 rounded-md"
                            >NOTICIAS</a
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('contacto')"
                            class="text-lg hover:bg-white p-3 rounded-md"
                            :class="{
                                'txt-colo-menu': !route().current('contacto'), // color por defecto
                                'txt-anaranjado-fuerte':
                                    route().current('contacto'), // color cuando está activo
                                'bg-white font-bold':
                                    route().current('contacto'), // estilos adicionales cuando está activo
                            }"
                        >
                            CONTACTO
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Botón de donación -->
        <div class="col-span-2 hidden lg:flex ju~stify-center items-center">
            <button
                class="bg-anaranjado pt-2 pb-2 pl-6 pr-6 rounded-md text-white text-lg roboto-condensed-semibold shadow-lg transition-transform duration-300 ease-in-out hover:scale-105"
                @click="$refs.modal.showModal()"
            >
                DONA AHORA
            </button>
        </div>

        <!-- Botón de menú hamburguesa (solo en móviles) -->
        <div class="col-span-9 flex justify-end items-center lg:hidden">
            <button
                @click="toggleMenu"
                class="text-gray-800 focus:outline-none"
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
        class="lg:hidden absolute top-20 left-0 w-full bg-white shadow-lg z-50"
    >
        <nav>
            <ul class="flex flex-col gap-3 p-5">
                <li>
                    <Link
                        :href="route('welcome')"
                        class="mi-elemento block text-lg p-3 hover:bg-gray-200 rounded-md active"
                        >INICIO</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('nosotros')"
                        class="block text-lg p-3 hover:bg-gray-200 rounded-md"
                        >NOSOTROS</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('ecosistema')"
                        class="block text-lg p-3 hover:bg-gray-200 rounded-md"
                        >ECOSISTEMA NINARI</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('programas')"
                        class="block text-lg p-3 hover:bg-gray-200 rounded-md"
                        >PROGRAMAS</Link
                    >
                </li>
                <li>
                    <a
                            href="https://www.instagram.com/ninarifoundation"
                            target="_blank"
                            class="block text-lg p-3 hover:bg-gray-200 rounded-md"
                            >NOTICIAS</a
                        >
                </li>
                <li>
                    <Link
                        :href="route('contacto')"
                        class="block text-lg p-3 hover:bg-gray-200 rounded-md"
                        >CONTACTO</Link
                    >
                </li>
                <li>
                    <button
                     @click="$refs.modal.showModal()"
                        class="w-full bg-anaranjado pt-2 pb-2 rounded-md text-white text-lg"
                    >
                        DONAR AHORA
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</template>

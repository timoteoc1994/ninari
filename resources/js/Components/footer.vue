<script setup>
import { computed } from "vue";
const instagram = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/redes_sociales/instagram.png`
);
const facebook = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/redes_sociales/facebook.png`
);
const linkenid = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/redes_sociales/linkenid.png`
);
const whatsapp = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/redes_sociales/whatsapp.png`
);
</script>

<template>
    <div
        class="bg_gris_claro grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 items-center mt-10 p-10"
    >
        <div class="text-center">
            <p
                class="roboto-condensed-semibold txt-azul text-xl md:text-xl lg:text-3xl xl:text-3xl"
            >
                NINARI Foundation 2025 Todos los derechos reservados
            </p>
        </div>

        <div
            class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-2 items-center"
        >
            <a
                href="https://www.linkedin.com/company/ninari-foundation/"
                target="_blank"
            >
                <img
                    class="max-w-[30%] sm:max-w-[30%] md:max-w-[40%] lg:max-w-[40%] xl:max-w-[40%] mx-auto transition-transform duration-300 ease-in-out hover:scale-110"
                    :src="linkenid"
                />
            </a>
            <a href="https://www.facebook.com/ninarifoundation" target="_blank">
                <img
                    class="max-w-[30%] sm:max-w-[30%] md:max-w-[40%] lg:max-w-[40%] xl:max-w-[40%] mx-auto transition-transform duration-300 ease-in-out hover:scale-110"
                    :src="facebook"
                />
            </a>
            <a
                href="https://www.instagram.com/ninarifoundation"
                target="_blank"
            >
                <img
                    class="max-w-[30%] sm:max-w-[30%] md:max-w-[40%] lg:max-w-[40%] xl:max-w-[40%] mx-auto transition-transform duration-300 ease-in-out hover:scale-110"
                    :src="instagram"
                />
            </a>
            <a
                href="https://api.whatsapp.com/send?phone=5930996694952"
                target="_blank"
            >
                <img
                    class="max-w-[30%] sm:max-w-[30%] md:max-w-[40%] lg:max-w-[40%] xl:max-w-[40%] mx-auto transition-transform duration-300 ease-in-out hover:scale-110"
                    :src="whatsapp"
                />
            </a>
        </div>
    </div>
</template>

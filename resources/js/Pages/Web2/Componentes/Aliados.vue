<script setup>
import { ref } from "vue";


// Imágenes de ejemplo (reemplazar con tus PNGs)
const aliadosweb = "/storage/webninari2/aliadosweb.webp";
const aliadosmovil = "/storage/webninari2/alidosmovil.webp";

</script>

<template>
    <section class="">
        <h2 class="section-title pt-6">Aliados</h2>
        <div class="aliados-media">
            <picture>
                <!-- mostrar imagen de móvil cuando la pantalla sea igual o menor a 768px -->
                <source :srcset="aliadosmovil" media="(max-width: 768px)" />
                <!-- por defecto mostrar la versión web -->
                <img :src="aliadosweb" alt="Aliados" class="aliados-img" loading="lazy" />
            </picture>
        </div>
        
    </section>
</template>

<style scoped>

.section-title {
    text-align: center;
    font-size: 3rem;
    font-weight: 800;
    color: #ff681c;
    margin-bottom: 4rem;
    font-family: "Barlow-Bold", sans-serif;
}

/* Estilos para las imágenes responsivas de aliados */
.aliados-media {
    display: flex;
    justify-content: center;
    align-items: center;
}

.aliados-img {
    width: 100%;
    max-width: 1200px;
    height: auto;
    display: block;
}



</style>

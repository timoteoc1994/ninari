<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Menunuevo from "@/Components/Menunuevo.vue";
import Footer from "@/Pages/Web2/Componentes/footer.vue";
import ChatbotNinari from "@/Components/ChatbotNinari.vue";




</script>

<template>
    <Head title="Inicio" />

    <div class="">
        <div class="div_astro">
            <div class="pb-6"><Menunuevo> </Menunuevo></div>

        </div>

        <Footer />

        <!-- Chatbot flotante -->
        <ChatbotNinari />
    </div>
</template>
<style scoped>


/* Finisher Header - contenedor principal */
.finisher-header {
    position: relative;
    width: 100%;
    /* usar mínimo 100vh pero permitir crecer si el contenido es más alto */
    min-height: 100vh;
    height: auto;
    overflow: visible; /* permitir que el contenido empuje y no se recorte */
    display: flex;
    flex-direction: column;
}


</style>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Menunuevo from "@/Components/Menunuevo.vue";
import Footer from "@/Pages/Web2/Componentes/footer.vue";
import ChatbotNinari from "@/Components/ChatbotNinari.vue";
import Equipo from "@/Pages/Web2/Componentes/Equipo.vue";
import Voluntariado from "@/Pages/Web2/Componentes/Voluntariado.vue";
import { onMounted } from "vue";
import AOS from "aos";
import "aos/dist/aos.css";

const nosotros = "/storage/webninari2/nosotros/nosotros.webp";
const icono = "/storage/webninari2/nosotros/icono.png";

onMounted(() => {
    AOS.init({
        duration: 1000,
        once: false, // Animación se repite al hacer scroll
        mirror: true,
    });
});
</script>

<template>
    <Head title="Nosotros" />
        <div class="div_astro">
            <div class="pb-6 relative z-[200]" data-aos="fade-down">
                <Menunuevo> </Menunuevo>
            </div>
            <div
                class="nosotros-bg "
                :style="{ backgroundImage: `url(${nosotros})` }"
            >
                <div class="px-5 sm:px-10 md:px-10 xl:px-28 lg:px-28 flex-1 flex flex-col justify-center relative z-[5]">
                    <h1
                        class="text-5xl text-white floating-anim"
                        data-aos="fade-right"
                        data-aos-delay="300"
                    >
                        Construimos un pais <br /><span class="font-bold"
                            >resiliente, sostenible</span
                        >
                        <br /><span class="font-bold">e innovador.</span>
                    </h1>
                    <div
                        class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 adelante"
                    >
                        <div data-aos="fade-up" data-aos-delay="600">
                            <p
                                class="text-white text-lg border rounded-md p-3 glass-effect"
                            >
                                Somos un equipos humano dedicado a articular y
                                servir a los actores del ecosistema del Ecuador.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="icono-container">
                    <img :src="icono" alt="" class="icono-img" />
                </div>
            </div>
        </div>
        <div data-aos="fade-up" data-aos-duration="1200">
            <Equipo />
        </div>

        <Voluntariado />

        <Footer />

        <!-- Chatbot flotante -->
        <ChatbotNinari />

</template>
<style scoped>
/* Fondo estilo Astro */
.div_astro {
    position: relative;
    width: 100%;
    min-height: 100vh;
    background: linear-gradient(
        to right,
        #4e1864 0%,
        #b5227a 40%,
        #995dbb 60%,
        #a880cf 100%
    );
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.nosotros-bg {
    width: 100%;
    flex: 1;
    background-size: contain;
    background-position: right top;
    background-repeat: no-repeat;
    display: flex;
    flex-direction: column;
    justify-content: right;
}
/* Móviles: usar cover para que la imagen llene el contenedor */
@media (max-width: 767px) {
    .nosotros-bg {
        background-size: cover;
        background-position: right bottom;
    }
}
.div_astro::before {
    content: "";
    position: absolute;
    top: -50%;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    height: 100%;
    background: radial-gradient(
        ellipse at center,
        rgba(168, 128, 207, 0.3) 0%,
        rgba(168, 128, 207, 0.1) 25%,
        transparent 70%
    );
    pointer-events: none;
}

.div_astro::after {
    content: "";
    position: absolute;
    bottom: -30%;
    right: 20%;
    width: 60%;
    height: 60%;
    background: radial-gradient(
        ellipse at center,
        rgba(120, 35, 128, 0.4) 0%,
        rgba(120, 35, 128, 0.2) 30%,
        transparent 70%
    );
    pointer-events: none;
}

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

/* Animación flotante continua */
.floating-anim {
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
    100% {
        transform: translateY(0px);
    }
}

/* Efecto de cristal para el texto */
.glass-effect {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.glass-effect:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
}

/* Contenedor del ícono */
.icono-container {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    padding-bottom: 0;
    position: relative;
    z-index: 10;
    transform: translateY(20px); /* Desplaza la imagen hacia abajo */
}

.icono-img {
    max-width: 100%;
    width: 100%;
    height: auto;
    filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3));
}
.adelante {
    z-index: 15;
}
</style>

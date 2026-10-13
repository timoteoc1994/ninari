<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { computed, onMounted } from "vue";
import Menunuevo from "@/Components/Menunuevo.vue";
import AOS from "aos";
import "aos/dist/aos.css";
const imagen1 = "/storage/webninari2/imagenesarticulamos/fondo.png";

onMounted(() => {
    //animaciones AOS hover
    AOS.init({
        duration: 1000, // duración en ms
        once: true, // animar solo una vez
    });
});
</script>

<template>
    <Head title="Inicio" />

    <div class="">
        <div
            class="finisher-header mb-6 pb-6 h-screen flex flex-col justify-between bg-center bg-cover"
            :style="{
                backgroundImage: `url(${imagen1})`,
                backgroundSize: 'cover',
                backgroundPosition: 'center center',
                backgroundRepeat: 'no-repeat',
                backgroundAttachment: 'scroll',
            }"
        >
            <!-- Wrapper para centrar el grid verticalmente -->
            <div class="flex-grow flex items-center justify-center w-full">
                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 lg:px-0 w-full max-w-7xl mx-auto relative z-10"
                >
                    <div class="bg-white/5 rounded-lg p-6" data-aos="fade-up">
                        <p class="colorazul">
                            <span class="resaltartext"
                                >articulamos y</span
                            >
                            <br />
                            <span class="resaltartext">creamos</span>
                            <br />
                            <span>
                                ECOSISTEMAS y <br />
                                <span>PROGRAMAS de</span> <br
                            /></span>
                            <span class="resaltartext">vanguardia </span>
                        </p>
                    </div>

                    <div
                        class="bg-white/5 rounded-lg p-6 flex items-center justify-center"
                        data-aos="fade-up"
                        data-aos-delay="100"
                    >
                        <img
                            src="/storage/webninari2/imagenesarticulamos/resaltado.png"
                            class="resalt-img resaltador_img"
                            alt="resaltado"
                        />
                    </div>

                    <div
                        class="bg-white/5 rounded-lg p-6"
                        data-aos="fade-up"
                        data-aos-delay="200"
                    >
                        <div class="fondo-anaranjado">
                            <p>
                                NINARI articula el ecosistema de innovación y
                                mercado para impulsar programas empresariales y
                                educativos de vanguardia. Desarrolla estrategias
                                de integración de cadenas de valor en sectores
                                especializados, promoviendo el desarrollo
                                regional y el mejoramiento de la calidad de vida
                                en comunidades vulnerables.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Curva decorativa: colocada debajo del grid, dentro del header -->
            <div class="justify-center flex">
                <img src="/storage/webninari2/imagenesarticulamos/curva.png" />
            </div>
        </div>
    </div>
</template>
<style scoped>
.colorazul {
    color: #534594;
    font-size: 30px;
    height: 0.9;
    font-family: "Barlow-Regular";
}

/* Highlight (resaltador) style for inline text */
.resaltartext {
    position: relative;
    display: inline-block;
    z-index: 1;
    font-weight: 700;
}
.resaltartext::after {
    content: "";
    position: absolute;
    left: -0.6em;
    right: -0.6em;
    top: 50%;
    height: 0.99em;
    background: #ffcd73;
    z-index: -1;
    border-radius: 3px;
    transform: translateY(-50%) skewX(-8deg);
    opacity: 0.95;
}

.fondo-anaranjado {
    background: #ec720b;
    padding: 15px;
    border-radius: 15px;
    font-family: "Barlow-Regular";
    font-size: 16px;
    line-height: 1.5;
    color: #ffffff;
    text-align: justify;
}
/* Animación sutil derecha-izquierda y resaltado para la imagen */
@keyframes slide-rl {
    0% {
        transform: translateX(6%);
    }
    50% {
        transform: translateX(-6%);
    }
    100% {
        transform: translateX(6%);
    }
}

@keyframes pulse-glow {
    0% {
        box-shadow: 0 8px 20px rgba(255, 205, 115, 0.12);
        filter: brightness(1);
    }
    50% {
        box-shadow: 0 18px 40px rgba(255, 205, 115, 0.22);
        filter: brightness(1.03);
    }
    100% {
        box-shadow: 0 8px 20px rgba(255, 205, 115, 0.12);
        filter: brightness(1);
    }
}

.resalt-img {
    max-width: 100%;
    height: auto;
    display: block;
    transform-origin: center;
    /* combinamos movimiento lento lateral y un glow pulsante */
    animation: slide-rl 8s ease-in-out infinite;
    transition: transform 200ms ease;
}

/* en hover/ foco hacemos un ligero escala para enfatizar */
.resalt-img:hover,
.resalt-img:focus {
    transform: scale(1.03);
}
@media (max-width: 1024px) {
    .resaltador_img {
        width: 250px !important;
    }
}
@media (max-width: 768px) {
    .resaltador_img {
        width: 250px !important;
    }
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


</style>

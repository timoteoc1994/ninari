<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import AOS from "aos";
import "aos/dist/aos.css";

const quintuple = "/storage/webninari2/ecosistema/quintuple.jpg";

onMounted(() => {
    AOS.init({
        duration: 1000,
        once: false, // Animación se repite al hacer scroll
        mirror: true,
    });
});
</script>

<template>
    <div>
    
        <div
            class="px-5 sm:px-10 md:px-10 xl:px-28 lg:px-28 flex-1 flex flex-col justify-center pt-6"
        >
            <h1 class="text-5xl color-azul font-bold">Quintuple Hélice</h1>
            <p class="text-2xl color-azul pt-3">
                <span>trabajamos con todos los </span>
                <span class="block mt-1"
                    ><span class="inline-block px-3 py-1 bg-[#EAC280]"
                        >actores del Ecosistema</span
                    ></span
                >
            </p>
            <div class="flex justify-center">
                <img
                    :src="quintuple"
                    alt="Quintuple Hélice"
                    class=" w-full max-w-6xl mt-6"
                    data-aos="fade-up"
                />
            </div>
        </div>
    </div>
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

.agentes-svg {
    width: 100%;
    height: auto;
    max-width: 100%;
    animation: float 6s ease-in-out infinite;
}

/* Animación flotante para el SVG */
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

/* Animación de pulso suave */
@keyframes pulse {
    0%,
    100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

/* Si quieres agregar efecto hover */
.agentes-svg:hover {
    animation: pulse 2s ease-in-out infinite;
}

/* Animaciones para elementos internos del SVG */
/* Animar diferentes grupos g del SVG */
#Capa_1 > g:nth-child(2) {
    animation: floatElement1 6s ease-in-out infinite;
    transform-origin: center;
}

#Capa_1 > g:nth-child(3) {
    animation: floatElement2 7s ease-in-out infinite 0.5s;
    transform-origin: center;
}

#Capa_1 > g:nth-child(4) {
    animation: floatElement3 8s ease-in-out infinite 1s;
    transform-origin: center;
}

#Capa_1 > g:nth-child(5) {
    animation: floatElement1 7.5s ease-in-out infinite 1.5s;
    transform-origin: center;
}

#Capa_1 > g:nth-child(6) {
    animation: floatElement2 6.5s ease-in-out infinite 0.8s;
    transform-origin: center;
}

/* Animar paths individuales */
#Capa_1 > path:nth-child(7),
#Capa_1 > path:nth-child(8),
#Capa_1 > path:nth-child(9) {
    animation: floatSmall 5s ease-in-out infinite;
    transform-origin: center;
}

#Capa_1 > path:nth-child(10),
#Capa_1 > path:nth-child(11),
#Capa_1 > path:nth-child(12) {
    animation: floatSmall 5.5s ease-in-out infinite 0.3s;
    transform-origin: center;
}

#Capa_1 > path:nth-child(13),
#Capa_1 > path:nth-child(14) {
    animation: floatSmall 6s ease-in-out infinite 0.6s;
    transform-origin: center;
}

/* Animación flotante 1 - Movimiento vertical con leve rotación */
@keyframes floatElement1 {
    0% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(2deg);
    }
    100% {
        transform: translateY(0px) rotate(0deg);
    }
}

/* Animación flotante 2 - Movimiento diagonal */
@keyframes floatElement2 {
    0% {
        transform: translate(0px, 0px) rotate(0deg);
    }
    50% {
        transform: translate(-10px, -25px) rotate(-2deg);
    }
    100% {
        transform: translate(0px, 0px) rotate(0deg);
    }
}

/* Animación flotante 3 - Movimiento circular */
@keyframes floatElement3 {
    0% {
        transform: translate(0px, 0px) scale(1);
    }
    25% {
        transform: translate(5px, -15px) scale(1.02);
    }
    50% {
        transform: translate(0px, -20px) scale(1);
    }
    75% {
        transform: translate(-5px, -15px) scale(1.02);
    }
    100% {
        transform: translate(0px, 0px) scale(1);
    }
}

/* Animación para elementos pequeños */
@keyframes floatSmall {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0px);
    }
}
</style>

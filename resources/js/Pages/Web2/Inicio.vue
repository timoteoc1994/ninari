<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { computed, onMounted } from "vue";
import Menunuevo from "@/Components/Menunuevo.vue";
import SeccionArticulamos from "@/Pages/Web2/Componentes/SeccionArticulamos.vue";
import EjesEstrategicos from "@/Pages/Web2/Componentes/EjesEstrategicos.vue";
import Aliados from "@/Pages/Web2/Componentes/Aliados.vue";
import Footer from "@/Pages/Web2/Componentes/footer.vue";
import ChatbotNinari from "@/Components/ChatbotNinari.vue";
import AOS from "aos";
import "aos/dist/aos.css";
const imagen1 = "/storage/imageninicio/r1.png";
const imagen2 = "/storage/imageninicio/r2.png";
const imagen3 = "/storage/imageninicio/r3.png";
const imagen4 = "/storage/imageninicio/r4.png";
const imagen5 = "/storage/imageninicio/r5.png";
const imagen6 = "/storage/imageninicio/r6.png";
const imagen7 = "/storage/imageninicio/r7.png";

onMounted(() => {
    //animaciones AOS hover
    AOS.init({
        duration: 1000, // duración en ms
        once: true, // animar solo una vez
    });

    // Cargar el script de Finisher Header dinámicamente
    const script = document.createElement("script");
    script.src = "/js/finisher-header.es5.min.js";
    script.onload = () => {
        // Inicializar Finisher Header con tus colores personalizados
        new window.FinisherHeader({
            count: 12,
            size: {
                min: 1300,
                max: 1500,
                pulse: 0,
            },
            speed: {
                x: {
                    min: 0.6,
                    max: 3,
                },
                y: {
                    min: 0.6,
                    max: 3,
                },
            },
            colors: {
                background: "#551368",
                particles: ["#ff681c", "#87ddfe", "#231efe", "#ff0a53"],
            },
            blending: "overlay",
            opacity: {
                center: 0.6,
                edge: 0,
            },
            skew: 0,
            shapes: ["c"],
        });
    };
    document.body.appendChild(script);
});
</script>

<template>
    <Head title="Inicio" />

    <div class="">
        <div class="finisher-header">
            <div class="pb-6"><Menunuevo> </Menunuevo></div>

            <!-- Imágenes flotantes -->
            <img :src="imagen1" class="floating-img img-1" alt="Innovación" />
            <img :src="imagen2" class="floating-img img-2" alt="Ideas" />
            <img :src="imagen3" class="floating-img img-3" alt="Creatividad" />
            <img :src="imagen4" class="floating-img img-4" alt="Desarrollo" />
            <img :src="imagen5" class="floating-img img-5" alt="Corazón" />
            <img :src="imagen6" class="floating-img img-6" alt="Mensaje" />
            <img :src="imagen7" class="floating-img img-7" alt="Cohete" />

            <!-- Contenido principal centrado -->
            <div class="contenido-principal">
                <button class="btn-impulsamos">impulsamos</button>
                <div data-aos="fade-up">
                    <h1 class="titulo-principal">
                        Innovación y <br />desarrollo sostenible
                    </h1>
                </div>
                <div class="caja-texto" data-aos="fade-up">
                    <p class="parrafo">
                        NINARI es una organización privada sin fines de lucro
                        que articula a los actores del ecosistema de innovación
                        para promover el desarrollo socioeconómico sostenible
                        del Ecuador.
                    </p>
                    <p class="parrafo">
                        A través de la innovación social, productiva y
                        comercial, buscamos generar soluciones efectivas a los
                        desafíos del territorio, fortaleciendo capacidades,
                        creando oportunidades y promoviendo regiones más
                        inclusivas, competitivas y sostenibles.
                    </p>
                </div>
            </div>
        </div>
        <SeccionArticulamos />
        <EjesEstrategicos />
        <Aliados />
        <Footer />

        <!-- Chatbot flotante -->
        <ChatbotNinari />
    </div>
</template>
<style scoped>
/* Animaciones para movimiento de gradientes */
@keyframes moveGradient1 {
    0% {
        transform: translate(0, 0) rotate(0deg);
    }
    33% {
        transform: translate(30%, -30%) rotate(120deg);
    }
    66% {
        transform: translate(-20%, 20%) rotate(240deg);
    }
    100% {
        transform: translate(0, 0) rotate(360deg);
    }
}

@keyframes moveGradient2 {
    0% {
        transform: translate(0, 0) rotate(0deg) scale(1);
    }
    33% {
        transform: translate(-25%, 25%) rotate(-120deg) scale(1.1);
    }
    66% {
        transform: translate(25%, -15%) rotate(-240deg) scale(0.95);
    }
    100% {
        transform: translate(0, 0) rotate(-360deg) scale(1);
    }
}

/* Animaciones de flotación para las formas geométricas */
@keyframes float {
    0%,
    100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(5deg);
    }
}

@keyframes float-delayed {
    0%,
    100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-30px) rotate(-5deg);
    }
}

@keyframes float-slow {
    0%,
    100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-15px) rotate(3deg);
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

/* Imágenes flotantes */
.floating-img {
    position: absolute;
    z-index: 20;
    pointer-events: none;
}

/* Posicionamiento de cada imagen imagen foco */
.img-1 {
    left: 14%;
    top: 23%;
    width: 150px;
    animation: float 8s ease-in-out infinite;
}
/* Posicionamiento de cada imagen imagen mensaje */
.img-2 {
    left: 65%;
    top: 20%;
    width: 170px;
    animation: float-delayed 10s ease-in-out infinite;
}
/* Posicionamiento de cada imagen imagen papel opaco */
.img-3 {
    left: 30%;
    bottom: 55%;
    width: 140px;
    animation: float-slow 12s ease-in-out infinite;
}
/* Posicionamiento de cada imagen foco opaco */
.img-4 {
    right: 8%;
    bottom: 35%;
    width: 150px;
    animation: float 7s ease-in-out infinite;
}
/* Posicionamiento de cada imagen imagen coete */
.img-5 {
    right: 15%;
    bottom: 10%;
    width: 150px;
    animation: float-delayed 9s ease-in-out infinite;
}
/* Posicionamiento de cada imagen imagen escudo */
.img-6 {
    right: 45%;
    top: 85%;
    width: 85px;
    animation: float-slow 11s ease-in-out infinite;
}
/* Posicionamiento de cada imagen imagen papel con grafico de pastel */
.img-7 {
    left: 15%;
    top: 80%;
    width: 120px;
    animation: float 10s ease-in-out infinite;
}

/* Contenido principal centrado */
.contenido-principal {
    position: relative;
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 60vh;
    padding: 4rem 2rem;
    text-align: center;
}

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

/* Título principal */
.titulo-principal {
    color: white;
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 2.5rem;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    max-width: 900px;
    font-family: "Barlow-Bold", sans-serif;
}

/* Caja de texto con borde */
.caja-texto {
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.6);
    border-radius: 20px;
    padding: 2rem 2.5rem;
    max-width: 850px;
    margin: 0 auto;
    backdrop-filter: blur(10px);
}

/* Párrafos */
.parrafo {
    color: white;
    font-size: 1.3rem;
    line-height: 0.9;
    margin-bottom: 1.2rem;
    text-align: justify;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    font-family: "Barlow-Regular", sans-serif;
}

.parrafo:last-child {
    margin-bottom: 0;
}

/* Responsive */
/* Ocultar imágenes flotantes en tablets y móviles */
@media (max-width: 1024px) {
    .img-3,
    .img-4,
    .img-5,
    .img-7 {
        display: none !important;
    }
}

@media (max-width: 768px) {
    .titulo-principal {
        font-size: 2.2rem;
    }

    .caja-texto {
        padding: 1.5rem;
    }

    .floating-img {
        width: 50px !important;
    }
    /* Ajustes de tamaño para imágenes visibles  para ceulares y tablet*/
    .img-1 {
        width: 100px !important;
    }
    .img-2 {
        width: 100px !important;
    }
    .img-6 {
        width: 80px !important;
    }
}
</style>

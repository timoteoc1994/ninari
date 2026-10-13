<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";
import Menunuevo from "@/Components/Menunuevo.vue";
import SeccionArticulamos from "@/Pages/Web2/Componentes/SeccionArticulamos.vue";
import EjesEstrategicos from "@/Pages/Web2/Componentes/EjesEstrategicos.vue";
import Aliados from "@/Pages/Web2/Componentes/Aliados.vue";
import Footer from "@/Pages/Web2/Componentes/footer.vue";
import ChatbotNinari from "@/Components/ChatbotNinari.vue";
import AOS from "aos";
import "aos/dist/aos.css";
const imagen1 = "/storage/webninari2/imageninicio/r1.png";
const imagen2 = "/storage/webninari2/imageninicio/r2.png";
const imagen3 = "/storage/webninari2/imageninicio/r3.png";
const imagen4 = "/storage/webninari2/imageninicio/r4.png";
const imagen5 = "/storage/webninari2/imageninicio/r5.png";
const imagen6 = "/storage/webninari2/imageninicio/r6.png";
const imagen7 = "/storage/webninari2/imageninicio/r7.png";
const coete = "/storage/webninari2/equipo/coete.png";
const showPopup = ref(false);

onMounted(() => {
    // Mostrar popup de voluntariado después de 3 segundos
    setTimeout(() => {
        showPopup.value = true;
    }, 3000);

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

        <!-- Popup Voluntariado -->
        <Transition name="popup">
            <div v-if="showPopup" class="popup-overlay" @click.self="showPopup = false">
                <div class="popup-card">
                    <button class="popup-close" @click="showPopup = false" aria-label="Cerrar">&times;</button>

                    

                    <h2 class="popup-title">
                        Pregunta por nuestro programa
                        <span class="popup-highlight">de Voluntariado</span>
                    </h2>

                    <p class="popup-body">


En la Fundación Ninari buscamos jóvenes que quieran fortalecer sus habilidades, ganar experiencia real y ser parte de proyectos de desarrollo económico sostenible, innovación y cooperación internacional 🌱🌍.
                    </p>

                    <a
                        href="https://portal.ninari.org/form/formulario-de-voluntariado"
                        target="_blank"
                        class="popup-btn"
                        @click="showPopup = false"
                    >
                        <div class="popup-coete floating-anim">
                            <img :src="coete" alt="Cohete" class="popup-coete-img" />
                        </div>
                        <span>Envíanos tu CV</span>
                    </a>
                </div>
            </div>
        </Transition>
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
    left: 3%;
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
    right: 10%;
    bottom: 10%;
    width: 150px;
    animation: float-delayed 9s ease-in-out infinite;
}
/* Posicionamiento de cada imagen imagen escudo */
.img-6 {
    right: 45%;
    top: 90%;
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

/* ── POPUP VOLUNTARIADO ── */
.popup-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
    backdrop-filter: blur(4px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.popup-card {
    position: relative;
    background: #fff;
    border-radius: 1.5rem;
    padding: 2.5rem 2rem 2rem;
    max-width: 480px;
    width: 100%;
    box-shadow: 0 20px 60px rgba(85, 19, 104, 0.35);
    text-align: center;
    overflow: hidden;
}

.popup-close {
    position: absolute;
    top: 0.75rem;
    right: 1rem;
    background: none;
    border: none;
    font-size: 1.75rem;
    line-height: 1;
    color: #888;
    cursor: pointer;
    transition: color 0.2s;
}

.popup-close:hover {
    color: #551368;
}

.popup-badge {
    display: inline-block;
    background: #EAC280;
    color: #551368;
    font-weight: 700;
    font-size: 0.8rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    padding: 0.3rem 1rem;
    border-radius: 999px;
    margin-bottom: 1rem;
}

.popup-title {
    color: #551368;
    font-size: 1.6rem;
    font-weight: 800;
    line-height: 1.25;
    margin-bottom: 1rem;
}

.popup-highlight {
    display: inline-block;
    background: #EAC280;
    padding: 0.1rem 0.5rem;
    border-radius: 4px;
    margin-top: 0.25rem;
}

.popup-body {
    color: #555;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1.75rem;
}

.popup-btn {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: linear-gradient(135deg, #995dbb 0%, #a880cf 100%);
    color: white;
    padding: 0.875rem 2rem 0.875rem 4rem;
    border-radius: 2rem;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
}

.popup-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(139, 92, 246, 0.6);
    background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
}

.popup-coete {
    position: absolute;
    left: -2rem;
    top: 50%;
    width: 6rem;
    height: 6rem;
    pointer-events: none;
}

.popup-coete-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.2));
}

.floating-anim {
    animation: float-centered 6s ease-in-out infinite;
}

@keyframes float-centered {
    0%   { transform: translateY(-50%); }
    50%  { transform: translateY(calc(-50% - 12px)); }
    100% { transform: translateY(-50%); }
}

/* Transición del popup */
.popup-enter-active,
.popup-leave-active {
    transition: opacity 0.35s ease, transform 0.35s ease;
}

.popup-enter-from,
.popup-leave-to {
    opacity: 0;
    transform: scale(0.9);
}
</style>

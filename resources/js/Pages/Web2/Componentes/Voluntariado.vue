<script setup>
const coete = "/storage/webninari2/equipo/coete.png";
const voluntario="/storage/webninari2/equipo/voluntario.webp";
</script>

<template>


    <div>
        <div class="div_astro bg-white">
            <div
                class="nosotros-bg"
                :style="{ backgroundImage: `url(${voluntario})` }"
            >
                <div
                    class="px-5 sm:px-10 md:px-10 xl:px-28 lg:px-28 space-y-10"
                >
                    <div
                        class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 xl:grid-cols-3"
                    >
                        <div class="rounded-xl color-naranja p-6">
                            <p class="text-white text-lg leading-tight">
                                Nuestro equipo reúne experiencia en medios de
                                vida y protección a través de la innovación,
                                trabajo a nivel nacional e internacional en
                                desarrollo y conocimiento de problemas complejos
                                de desarrollo y sus contextos. Trabajamos con
                                integridad. Valoramos la diversidad de
                                antecedentes, experiencias y pensamientos.
                            </p>
                        </div>
                    </div>
                    <div>
                        <p class="color-azul font-bold text-lg leading-tight">
                            Pregunta por nuestro programa
                            <span class="block mt-1">
                                <span
                                    class="inline-block px-3 py-1 bg-[#EAC280]"
                                >
                                    de Voluntariado
                                </span>
                            </span>
                        </p>
                    </div>
                    <a 
                        href="https://portal.ninari.org/form/formulario-de-voluntariado" 
                        target="_blank"
                        class="btn-enviar-cv"
                    >
                        <div class="coete-wrapper floating-anim">
                            <img :src="coete" alt="Cohete" class="coete-img" data-aos="fade-right" data-aos-delay="300">
                        </div>
                        <span>Envíanos tu CV</span>
                    </a>
                </div>
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
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.nosotros-bg {
    width: 100%;
    flex: 1;
    background-size: contain;
    background-position: right bottom;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
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
    pointer-events: none;
}

.div_astro::after {
    content: "";
    position: absolute;
    bottom: -30%;
    right: 20%;
    width: 60%;
    height: 60%;
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


/* Botón Envianos tu CV */
.btn-enviar-cv {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: linear-gradient(135deg, #995DBB 0%, #A880CF 100%);
    color: white;
    padding: 0.875rem 2rem 0.875rem 4rem;
    border-radius: 2rem;
    font-size: 1.125rem;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
    cursor: pointer;
}

.btn-enviar-cv:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(139, 92, 246, 0.6);
    background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
}

.btn-enviar-cv:active {
    transform: translateY(0);
}

.coete-wrapper {
    position: absolute;
    left: -2rem;
    top: 50%;
    width: 7.5rem;
    height: 7.5rem;
    pointer-events: none;
    z-index: 10;
}

.coete-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.2));
}

/* Animación flotante que respeta el centrado vertical */
.floating-anim {
    animation: float-centered 6s ease-in-out infinite;
}

@keyframes float-centered {
    0% {
        transform: translateY(-50%);
    }
    50% {
        transform: translateY(calc(-50% - 15px));
    }
    100% {
        transform: translateY(-50%);
    }
}
</style>

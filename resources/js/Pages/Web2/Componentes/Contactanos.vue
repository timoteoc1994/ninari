<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";
import AOS from "aos";
import "aos/dist/aos.css";

const imagen2 = "/storage/webninari2/imageninicio/r2.png";
const imagen3 = "/storage/webninari2/imageninicio/r3.png";
const imagen4 = "/storage/webninari2/imageninicio/r4.png";
const coete = "/storage/webninari2/imageninicio/r5.png";
const personas = "/storage/webninari2/contacto/personas.webp";

const mensajeExito = ref(false);

const form = useForm({
    nombre: '',
    email: '',
    mensaje: ''
});

const enviarFormulario = () => {
    form.post(route('contacto.guardar'), {
        onSuccess: () => {
            mensajeExito.value = true;
            form.reset();
           
        },
        onError: () => {
            console.log('Error al enviar el formulario');
        }
    });
};


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


    <div class="">
        <div class="finisher-header">

            <!-- Imágenes flotantes -->
       
            <img :src="imagen2" class="floating-img img-2" alt="Ideas" />
            <img :src="imagen3" class="floating-img img-3" alt="Creatividad" />
            <img :src="imagen4" class="floating-img img-4" alt="Desarrollo" />
            <!-- Contenido principal centrado -->
             <div class="px-5 sm:px-10 md:px-10 xl:px-28 lg:px-28 flex-1 flex flex-col justify-center pt-6 pb-10">
                <div class="contenedor-formulario">
                    <div class="columna-formulario">
                        <h1 class="titulo-contacto">¡Contáctanos!</h1>
                        
                        <!-- Mensaje de éxito -->
                        <div v-if="mensajeExito" class="mensaje-exito">
                            <p>✓ ¡Mensaje enviado correctamente! Pronto nos contactaremos contigo.</p>
                        </div>

                        <form @submit.prevent="enviarFormulario" class="formulario-contacto">
                            <input 
                                v-model="form.nombre"
                                type="text" 
                                placeholder="Nombre:" 
                                class="input-contacto"
                                :class="{ 'input-error': form.errors.nombre }"
                                required
                            />
                            <span v-if="form.errors.nombre" class="error-text">{{ form.errors.nombre }}</span>
                            
                            <input 
                                v-model="form.email"
                                type="email" 
                                placeholder="Email:" 
                                class="input-contacto"
                                :class="{ 'input-error': form.errors.email }"
                                required
                            />
                            <span v-if="form.errors.email" class="error-text">{{ form.errors.email }}</span>
                            
                            <textarea 
                                v-model="form.mensaje"
                                placeholder="Mensaje:" 
                                class="textarea-contacto"
                                :class="{ 'input-error': form.errors.mensaje }"
                                rows="6"
                                required
                            ></textarea>
                            <span v-if="form.errors.mensaje" class="error-text">{{ form.errors.mensaje }}</span>
                            
                            <button type="submit" class="btn-enviar" :disabled="form.processing">
                                <img :src="coete" alt="Enviar" class="icono-cohete" />
                                {{ form.processing ? 'Enviando...' : 'Enviar' }}
                            </button>
                        </form>
                    </div>
                    <div class="columna-imagen">
                        <img :src="personas" alt="Contacto" class="imagen-personas" />
                    </div>
                </div>
             </div>
            
        </div>
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

/* Estilos del formulario de contacto */
.contenedor-formulario {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
}

.columna-formulario {
    display: flex;
    flex-direction: column;
}

.columna-imagen {
    display: flex;
    justify-content: center;
    align-items: center;
}

.imagen-personas {
    max-width: 100%;
    height: auto;
    filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.3));
    animation: float-slow 8s ease-in-out infinite;
}

.titulo-contacto {
    color: white;
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 2rem;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    font-family: "Barlow-Bold", sans-serif;
}

.formulario-contacto {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
    max-width: 100%;
}

.mensaje-exito {
    background: rgba(76, 175, 80, 0.9);
    border: 2px solid rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    animation: slideDown 0.5s ease-out;
}

.mensaje-exito p {
    color: white;
    font-size: 1.1rem;
    margin: 0;
    font-family: "Barlow-Bold", sans-serif;
    text-align: center;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.input-error {
    border-color: #ff0a53 !important;
}

.error-text {
    color: #ff0a53;
    font-size: 0.9rem;
    margin-top: -0.8rem;
    font-family: "Barlow-Regular", sans-serif;
}

.btn-enviar:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.input-contacto,
.textarea-contacto {
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    padding: 1rem 1.5rem;
    color: white;
    font-size: 1.1rem;
    font-family: "Barlow-Regular", sans-serif;
    transition: all 0.3s ease;
    outline: none;
}

.input-contacto::placeholder,
.textarea-contacto::placeholder {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
}

.input-contacto:focus,
.textarea-contacto:focus {
    border-color: white;
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
}

.textarea-contacto {
    resize: vertical;
    min-height: 150px;
}

.btn-enviar {
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.9);
    border-radius: 30px;
    padding: 0.75rem 2.5rem 0.75rem 4rem;
    color: white;
    font-size: 1.2rem;
    font-weight: 700;
    font-family: "Barlow-Bold", sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    width: fit-content;
    overflow: visible;
}

.btn-enviar:hover {
    border-color: white;
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.icono-cohete {
    position: absolute;
    left: -15px;
    top: 50%;
    transform: translateY(-50%);
    width: 100px;
    height: 100px;
    object-fit: contain;
    z-index: 10;
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

@media (max-width: 1024px) {
    .contenedor-formulario {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .columna-imagen {
        order: -1;
    }

    .imagen-personas {
        max-width: 400px;
    }
}

@media (max-width: 768px) {
    .titulo-principal {
        font-size: 2.2rem;
    }

    .titulo-contacto {
        font-size: 2.5rem;
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

    .formulario-contacto {
        max-width: 100%;
    }

    .input-contacto,
    .textarea-contacto {
        font-size: 1rem;
    }

    .btn-enviar {
        font-size: 1.1rem;
        padding: 0.7rem 1.5rem;
    }

    .icono-cohete {
        width: 50px;
        height: 50px;
    }

    .imagen-personas {
        max-width: 300px;
    }
}
</style>

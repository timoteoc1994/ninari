<script setup>
import { ref } from "vue";

// Estado para controlar qué tarjetas están volteadas
const flipped = ref([false, false, false]);

// Función para voltear una tarjeta
const toggleFlip = (index) => {
    flipped.value[index] = !flipped.value[index];
};

// Imágenes de ejemplo (reemplazar con tus PNGs)
const imgDesarrollo = "/storage/webninari2/imagenarbol.webp";
const imgInnovacion = "/storage/webninari2/imagenfoco.webp";
const imgDerechos = "/storage/webninari2/imagenescudo.webp";
</script>

<template>
    <section class="">
        <h2 class="section-title">Ejes estratégicos</h2>

        <div class="cards-container">
            <!-- Tarjeta 1: Desarrollo Económico -->
            <div
                class="card-wrapper"
                :class="{ flipped: flipped[0] }"
                @mouseenter="flipped[0] = true"
                @mouseleave="flipped[0] = false"
            >
                <div class="card">
                    <!-- Cara frontal -->
                    <div class="card-front">
                        <h3 class="card-title">
                            DESARROLLO ECONÓMICO<br />SOSTENIBLE:
                        </h3>
                        <div class="card-image">
                            <img :src="imgDesarrollo" alt="Desarrollo Económico" />
                        </div>
                        <button
                            class="btn-arrow"
                            @click.stop="toggleFlip(0)"
                            aria-label="Ver más"
                        >
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="3"
                            >
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>

                    <!-- Cara trasera -->
                    <div class="card-back">
                        <h3 class="card-title-back">
                            DESARROLLO ECONÓMICO<br />SOSTENIBLE:
                        </h3>
                        <div class="card-content">
                            <p>Construcción de ecosistemas</p>
                            <p>I+D+i Industrias</p>
                            <p>Impulso al Emprendimiento</p>
                            <p>Economía Naranja</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 2: Innovación -->
            <div
                class="card-wrapper"
                :class="{ flipped: flipped[1] }"
                @mouseenter="flipped[1] = true"
                @mouseleave="flipped[1] = false"
            >
                <div class="card">
                    <!-- Cara frontal -->
                    <div class="card-front">
                        <h3 class="card-title">INNOVACIÓN:</h3>
                        <div class="card-image">
                            <img :src="imgInnovacion" alt="Innovación" />
                        </div>
                        <button
                            class="btn-arrow"
                            @click.stop="toggleFlip(1)"
                            aria-label="Ver más"
                        >
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="3"
                            >
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>

                    <!-- Cara trasera -->
                    <div class="card-back">
                        <h3 class="card-title-back">INNOVACIÓN:</h3>
                        <div class="card-content">
                            <p>Innovación Social</p>
                            <p>Innovación Productiva</p>
                            <p>Innovación Comercial</p>
                            <p>Innovación Abierta</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 3: Derechos y Protección -->
            <div
                class="card-wrapper"
                :class="{ flipped: flipped[2] }"
                @mouseenter="flipped[2] = true"
                @mouseleave="flipped[2] = false"
            >
                <div class="card">
                    <!-- Cara frontal -->
                    <div class="card-front">
                        <h3 class="card-title">DERECHOS Y PROTECCIÓN</h3>
                        <div class="card-image">
                            <img :src="imgDerechos" alt="Derechos y Protección" />
                        </div>
                        <button
                            class="btn-arrow"
                            @click.stop="toggleFlip(2)"
                            aria-label="Ver más"
                        >
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="3"
                            >
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>

                    <!-- Cara trasera -->
                    <div class="card-back">
                        <h3 class="card-title-back">DERECHOS Y PROTECCIÓN</h3>
                        <div class="card-content">
                            <p>Enfoque de Género</p>
                            <p>Generacional</p>
                            <p>Intercultural</p>
                        </div>
                    </div>
                </div>
            </div>
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

.cards-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2.5rem;
}

.card-wrapper {
    perspective: 1000px;
    height: 450px;
}

.card {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.6s;
    transform-style: preserve-3d;
}

.card-wrapper.flipped .card {
    transform: rotateY(180deg);
}

.card-front,
.card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 30px;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
}

/* Cara frontal con degradado morado (de abajo hacia arriba) */
.card-front {
    /* El degradado ahora va de abajo (primer color) hacia arriba (último color) */
    background: linear-gradient(to top, #551368 0%, #7b1fa2 50%, #c147e0 100%);
    color: white;
    background-repeat: no-repeat;
    background-size: cover;
    /* Posición inicial en la parte inferior; útil si quieres animar el fondo */
    background-position: bottom;
    transition: background-position 0.6s ease;
}

.card-title {
    font-size: 1.3rem;
    font-weight: 700;
    text-align: center;
    line-height: 1.3;
    font-family: "Abel-Pro-Bold", "Arial", Helvetica, sans-serif;
    margin-bottom: 1rem;
}

.card-image {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.card-image img {
    max-width: 100%;
    max-height: 220px;
    object-fit: contain;
    filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.2));
}

.btn-arrow {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.958);
    border: 2px solid #EC720B;
    color: #EC720B;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-arrow:hover {
    background: rgba(255, 255, 255, 0.4);
    transform: scale(1.1);
}

/* Cara trasera con color naranja */
.card-back {
    background: #ff681c;
    color: white;
    transform: rotateY(180deg);
    justify-content: flex-start;
}

.card-title-back {
    font-size: 1.3rem;
    font-weight: 700;
    text-align: center;
    line-height: 1.3;
    font-family: "Barlow-Bold", sans-serif;
    margin-bottom: 2rem;
}

.card-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 1.5rem;
    width: 100%;
    font-family: "Abel-Pro", sans-serif;
}

.card-content p {
    font-size: 1.2rem;
    text-align: center;
    line-height: 0.1;
    font-family: "Abel-Pro", sans-serif;
    margin: 0;
}

/* Responsive */
@media (max-width: 1024px) {
    .cards-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
    }

    .card-wrapper {
        height: 400px;
    }
}

@media (max-width: 768px) {
    .ejes-section {
        padding: 3rem 1.5rem;
    }

    .section-title {
        font-size: 2rem;
        margin-bottom: 2.5rem;
    }

    .cards-container {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .card-wrapper {
        height: 420px;
    }

    .card-title {
        font-size: 1.1rem;
    }

    .card-title-back {
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }

    .card-content p {
        font-size: 1.1rem;
    }

    .card-image img {
        max-height: 180px;
    }
}



</style>

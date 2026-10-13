<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

// Array de programas - agregar link solo si existe, dejarlo vacío "" si no tiene
const programas = [
    {
        nombre: "Tungurahua Fashion Week",
        imagen: "/storage/webninari2/proyecto/tfw.webp",
        link: "https://tungurahuafw.org/" // Ejemplo: "https://ejemplo.com/tfw"
    },
    {
        nombre: "Artesana",
        imagen: "/storage/webninari2/proyecto/artesana.webp",
        link: ""
    },
    {
        nombre: "ADRI",
        imagen: "/storage/webninari2/proyecto/adri.webp",
        link: "https://adri.renarec.org/"
    },
    {
        nombre: "Ayuda en Acción",
        imagen: "/storage/webninari2/proyecto/ayuda_en_accion.webp",
        link: "https://ayudaenaccion.ninari.org/"
    },
    {
        nombre: "Amazon Fair Trade",
        imagen: "/storage/webninari2/proyecto/fair_trade.webp",
        link: "https://amazonfairtrade.org/"
    },
    {
        nombre: "Woman Innovation Lab",
        imagen: "/storage/webninari2/proyecto/wilab.webp",
        link: "https://wilab.ninari.org/"
    },
    {
        nombre: "Sueños de Navidad",
        imagen: "/storage/webninari2/proyecto/navidad.webp",
        link: ""
    },
    {
        nombre: "COICA",
        imagen: "/storage/webninari2/proyecto/coica.webp",
        link: "https://conamazonia.com/"
    },
];

// Estado del modal
const showModal = ref(false);
const currentIndex = ref(0);

const openModal = (index) => {
    currentIndex.value = index;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

const nextImage = () => {
    currentIndex.value = (currentIndex.value + 1) % programas.length;
};

const prevImage = () => {
    currentIndex.value = (currentIndex.value - 1 + programas.length) % programas.length;
};

// Cerrar con tecla Escape
const handleKeydown = (e) => {
    if (e.key === 'Escape') closeModal();
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') prevImage();
};

// Listener para teclado
if (typeof window !== 'undefined') {
    window.addEventListener('keydown', handleKeydown);
}
</script>

<template>
    <Head title="Programas" />

    <section class="gallery-section bg-white">
     
        
        <div class="masonry-grid">
            <figure
                v-for="(programa, i) in programas"
                :key="i"
                class="masonry-item"
                @click="openModal(i)"
            >
                <img :src="programa.imagen" :alt="programa.nombre" loading="lazy" />
                <div class="overlay">
                    <h3 class="project-name">{{ programa.nombre }}</h3>
                    <a 
                        v-if="programa.link" 
                        :href="programa.link" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="btn-conocer-mas"
                        @click.stop
                    >
                        Conocer más
                    </a>
                </div>
            </figure>
        </div>

        <!-- Modal para ver imagen en grande -->
        <Transition name="modal">
            <div v-if="showModal" class="modal-overlay" @click="closeModal">
                <button class="close-btn" @click.stop="closeModal">✕</button>
                <button class="nav-btn prev-btn" @click.stop="prevImage">‹</button>
                <button class="nav-btn next-btn" @click.stop="nextImage">›</button>
                
                <div class="modal-content" @click.stop>
                    <img :src="programas[currentIndex].imagen" :alt="programas[currentIndex].nombre" />
                    <h3 class="modal-title">{{ programas[currentIndex].nombre }}</h3>
                </div>
            </div>
        </Transition>
    </section>
</template>

<style scoped>
.gallery-section {
    padding: 2rem 4rem;
    margin: 0 auto;
}

.gallery-title {
    font-family: "Barlow-Regular", sans-serif;
    color: #534584;
    font-size: 2rem;
    margin-bottom: 2rem;
    text-align: center;
}

/* Masonry real con CSS columns - mantiene proporción natural */
.masonry-grid {
    column-count: 3;
    column-gap: 1.5rem;
}

.masonry-item {
    margin: 0 0 1.5rem 0;
    break-inside: avoid;
    display: inline-block;
    width: 100%;
    border-radius: 35px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    position: relative;
}

.masonry-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
}

.masonry-item:hover .overlay {
    opacity: 1;
}

.masonry-item img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}

/* Overlay con nombre del proyecto */
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(83, 69, 132, 0.85);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.project-name {
    color: white;
    font-family: "Barlow-Regular", sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
    text-align: center;
    padding: 1rem;
    margin-bottom: 0.5rem;
}

.btn-conocer-mas {
    display: inline-block;
    background: white;
    color: #534584;
    padding: 0.75rem 2rem;
    border-radius: 25px;
    font-family: "Barlow-Regular", sans-serif;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.btn-conocer-mas:hover {
    background: #534584;
    color: white;
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

/* Modal */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.95);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 2rem;
}

.modal-content {
    max-width: 90vw;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
}

.modal-content img {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
}

.modal-title {
    color: white;
    font-family: "Barlow-Regular", sans-serif;
    font-size: 2rem;
    font-weight: 600;
    text-align: center;
}

/* Botones del modal */
.close-btn {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid white;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 2rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
}

.close-btn:hover {
    background: white;
    color: #534584;
    transform: rotate(90deg);
}

.nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid white;
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    font-size: 3rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
}

.nav-btn:hover {
    background: white;
    color: #534584;
}

.prev-btn {
    left: 2rem;
}

.next-btn {
    right: 2rem;
}

/* Transiciones del modal */
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

/* Responsive */
@media (max-width: 1200px) {
    .masonry-grid {
        column-count: 2;
    }
}

@media (max-width: 768px) {
    .masonry-grid {
        column-count: 2;
        column-gap: 1rem;
    }
    .masonry-item {
        margin-bottom: 1rem;
    }
    .gallery-title { 
        font-size: 1.5rem; 
    }
    .project-name {
        font-size: 1.2rem;
    }
    .modal-title {
        font-size: 1.5rem;
    }
    .nav-btn {
        width: 50px;
        height: 50px;
        font-size: 2rem;
    }
    .prev-btn {
        left: 1rem;
    }
    .next-btn {
        right: 1rem;
    }
}

@media (max-width: 480px) {
    .masonry-grid { 
        column-count: 1;
    }
    .gallery-section {
        padding: 2rem 1rem;
    }
    .nav-btn {
        width: 40px;
        height: 40px;
        font-size: 1.5rem;
    }
    .close-btn {
        width: 40px;
        height: 40px;
        top: 1rem;
        right: 1rem;
    }
}
</style>
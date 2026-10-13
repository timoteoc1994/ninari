<script setup>
import { ref } from "vue";

// Logo para el overlay - Cambia esta ruta por tu logo
const logoOverlay = "/storage/webninari2/equipo/11.png";

// Array con información del equipo
const teamMembers = [
    {
        id: 1,
        imagen: "/storage/webninari2/equipo/1.webp",
        nombre: "Ruth Bolaños Núñez.",
        cargo: "Directora Ejecutiva Founder",
        linkedin: "https://www.linkedin.com/in/ruthbolanos/"
    },
    {
        id: 2,
        imagen: "/storage/webninari2/equipo/2.webp",
        nombre: "Akapana Yantalema.",
        cargo: "Coordinador Zona norte Founder",
        linkedin: "https://www.linkedin.com/in/akapana-yantalema/"
    },
    {
        id: 3,
        imagen: "/storage/webninari2/equipo/3.webp",
        nombre: "Erika Sánchez A.",
        cargo: "Cordinadora de Proyectos",
        linkedin: "https://www.linkedin.com/in/erika-s%C3%A1nchez-b31398166/"
    },
    {
        id: 4,
        imagen: "/storage/webninari2/equipo/4.webp",
        nombre: "Jose Lascano.",
        cargo: "Coordinador Administrativo",
        linkedin: "https://www.linkedin.com/in/jose-lascano-calvopi%C3%B1a-a7aa181b9/"
    },
    {
        id: 5,
        imagen: "/storage/webninari2/equipo/5.webp",
        nombre: "Juan José Lara.",
        cargo: "Técnico en Innovación",
        linkedin: "https://www.linkedin.com/in/juan-jos%C3%A9-lara-soria-232b91352/"
    },
    {
        id: 6,
        imagen: "/storage/webninari2/equipo/6.webp",
        nombre: "Timoteo Cain.",
        cargo: "Técnico en Sistemas",
        linkedin: "https://www.linkedin.com/in/timoteo-cain-059456290/"
    },
   
  
    {
        id: 9,
        imagen: "/storage/webninari2/equipo/9.webp",
        nombre: "Erika Villacís.",
        cargo: "Técnica en Innovación",
        linkedin: "https://www.linkedin.com/in/erika-villacis-69485b263/"
    },
    {
        id: 10,
        imagen: "/storage/webninari2/equipo/10.webp",
        nombre: "Lissette Acosta.",
        cargo: "Técnica en Innovación",
        linkedin: "https://www.linkedin.com/in/lissette-acosta-3221b2195/"
    }
];

// Función para abrir LinkedIn
const openLinkedIn = (url) => {
    window.open(url, '_blank');
};
</script>

<template>
    <section class="bg-white">
        <h2 class="section-title pt-6">Equipo</h2>
        <div
            class="sm:px-10 md:px-10 xl:px-28 lg:px-28 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-6 gap-4 px-6 pb-12"
        >
            <div v-for="member in teamMembers" :key="member.id">
                <div class="image-container" @click="openLinkedIn(member.linkedin)">
                    <img
                        :src="member.imagen"
                        :alt="member.nombre"
                        class="w-full h-auto imgen-equipo"
                    />
                    <div class="glass-overlay">
                        <img :src="logoOverlay" alt="Logo" class="overlay-logo" />
                    </div>
                </div>
                <div class="pt-3">
                    <p class="font-bold color-azul">{{ member.nombre }}</p>
                    <p class="color-azul">{{ member.cargo }}</p>
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
    margin-bottom: 1rem;
    font-family: "Barlow-Bold", sans-serif;
}

.imgen-equipo {
    border-radius: 0.85rem;
}

/* Contenedor de imagen con overlay */
.image-container {
    position: relative;
    overflow: hidden;
    border-radius: 0.85rem;
    cursor: pointer;
}

/* Overlay tipo vidrio */
.glass-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #4E186480; /* Color con opacidad */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

/* Mostrar overlay en hover */
.image-container:hover .glass-overlay {
    opacity: 1;
}

/* Logo centrado */
.overlay-logo {
    width: 15%;
    max-width: 150px;
    height: auto;
    filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.3));
    animation: logoAppear 0.3s ease-in-out;
}

/* Animación de aparición del logo */
@keyframes logoAppear {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}
</style>

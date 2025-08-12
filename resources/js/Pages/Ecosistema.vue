<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import Menu from "@/Components/menu.vue";
import Footer from "@/Components/footer.vue";
import { ref, onMounted, onUnmounted } from "vue";

const ecosistema_ninari = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/ecosistema_ninari.png`
);
const sectores = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/sectores.png`
);
const quintuple_elice = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/quintuple_elice.png`
);
const open_innovacion = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/open_innovacion.png`
);
const cuissine = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/cuissine.png`
);
const iste = computed(() => `${import.meta.env.VITE_APP_URL}/storage/iste.png`);
const iconoecosistema = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/iconoecosistema.png`
);

const containerRef = ref(null);
const imageRef = ref(null);
const activeCircle = ref(null);
const imageAspectRatio = ref(1);
const windowWidth = ref(window.innerWidth);

const areas = [
    { bottom: "10%", left: "7%", size: 7 },
    { bottom: "38%", left: "23%", size: 7 },
    { bottom: "50%", left: "45%", size: 7 },
    { bottom: "39%", right: "23%", size: 7 },
    { bottom: "10%", right: "7%", size: 7 },
];

const buttons = [
    { id: 1, text: "CULTURA", bottom: "25%", left: "25%", circle: "circle-1" },
    {
        id: 2,
        text: "AGENTES DE CAMBIO",
        bottom: "18%",
        left: "20%",
        circle: "circle-1",
    },
    {
        id: 3,
        text: "INNOVACIÓN",
        bottom: "30%",
        left: "35%",
        circle: "circle-2",
    },
    {
        id: 4,
        text: "NORMATIVAS",
        bottom: "35%",
        left: "50%",
        circle: "circle-3",
        transform: "translateX(-50%)",
    },
    {
        id: 5,
        text: "FINANCIAMIENTO",
        bottom: "30%",
        right: "35%",
        circle: "circle-4",
    },
    { id: 6, text: "MERCADO", bottom: "25%", right: "25%", circle: "circle-5" },
    {
        id: 7,
        text: "SOPORTE TECNOLÓGICO",
        bottom: "18%",
        right: "20%",
        circle: "circle-5",
    },
];

const toggleButtons = (circleId) => {
    if (activeCircle.value === circleId) {
        activeCircle.value = null;
    } else {
        activeCircle.value = circleId;
    }
};

const updateDimensions = () => {
    if (imageRef.value) {
        imageAspectRatio.value =
            imageRef.value.naturalWidth / imageRef.value.naturalHeight;
    }
    windowWidth.value = window.innerWidth;
};

const responsiveSize = computed(() => {
    if (windowWidth.value < 640) return 1.25; // sm
    if (windowWidth.value < 768) return 1.25; // md
    if (windowWidth.value < 1024) return 1.25; // lg
    if (windowWidth.value < 1280) return 1.25; // xl
    return 1.5; // 2xl
});

const getAreaStyle = (area) => {
    const containerWidth = containerRef.value
        ? containerRef.value.offsetWidth
        : 0;
    const containerHeight = containerWidth / imageAspectRatio.value;
    const baseSize = (area.size / 100) * containerWidth;
    const size = `${baseSize * responsiveSize.value}px`;

    const style = {
        width: size,
        height: size,
    };

    if (area.bottom) style.bottom = area.bottom;
    if (area.left) style.left = area.left;
    if (area.right) style.right = area.right;

    return style;
};

const getButtonStyle = (button) => {
    const style = {};
    if (button.bottom) style.bottom = button.bottom;
    if (button.left) style.left = button.left;
    if (button.right) style.right = button.right;
    if (button.transform) style.transform = button.transform;
    return style;
};

onMounted(() => {
    window.addEventListener("resize", updateDimensions);
    updateDimensions();
});

onUnmounted(() => {
    window.removeEventListener("resize", updateDimensions);
});
</script>

<template>
    <Head title="Nosotros" />
    <div class="bg-gris relative">
        <!-- Contenido -->
        <div class="pt-6 pb-6">
            <Menu> </Menu>
            <div class="w-11/12 m-auto">
                <div class="">
                    <div class="bg-amarillo rounded-t-30">
                        <div className="grid grid-cols-12 gap-4">
                            <div
                                className="col-span-full sm:col-span-full md:col-span-8 lg:col-span-8 xl:col-span-8 p-10"
                            >
                                <img
                                    class="max-w-[90%] sm:max-w-[80%] md:max-w-[100%] lg:max-w-[100%] xl:max-w-[100%] h-auto mx-auto sm:pt-10"
                                    :src="ecosistema_ninari"
                                />
                            </div>
                            <div
                                className="col-span-full sm:col-span-full md:col-start-9 lg:col-start-9 xl:col-start-9 text-center  sm:text-center md:text-left md:flex md:items-end"
                            >
                                <div className="relative animate-fadeInUp">
                                    <p
                                        className="brandonGrotesque-regular txt-azul text-3xl sm:text-3xl md:text-2xl lg:text-3xl xl:text-5xl"
                                    >
                                        RED DE ALIADOS
                                    </p>
                                    <p
                                        className="brandonGrotesque-regular txt-anaranjado-fuerte text-2xl sm:text-2xl md:text-1xl lg:text-2xl xl:text-4xl"
                                    >
                                        DE INNOVACIÓN PARA
                                    </p>
                                    <p
                                        className="brandonGrotesque-regular txt-azul text-2xl sm:text-2xl md:text-1xl lg:text-2xl xl:text-4xl"
                                    >
                                        LA INTERVENCIÓN DE
                                    </p>
                                    <p
                                        className="brandonGrotesque-regular txt-anaranjado-fuerte text-5xl sm:text-5xl md:text-4xl lg:text-5xl xl:text-7xl"
                                    >
                                        IMPACTO
                                    </p>
                                </div>
                            </div>
                        </div>

                        <p
                            class="text-center pt-10 pb-10 roboto-condensed-semibold txt-azul text-2xl sm:text-2xl md:text-1xl lg:text-2xl xl:text-4xl animate-fadeInUp"
                        >
                            Construimos y fortalecemos ECOSISTEMAS trabajando
                            con la QUÍNTUPLE HÉLICE
                        </p>
                    </div>
                    <div class="relative" ref="containerRef">
                        <img
                            ref="imageRef"
                            class="w-full h-auto mx-auto object-cover"
                            :src="sectores"
                            alt="Sectores"
                            @load="updateDimensions"
                        />
                        <div
                            v-for="(area, index) in areas"
                            :key="index"
                            class="clickable-area"
                            :style="getAreaStyle(area)"
                            @click="toggleButtons(`circle-${index + 1}`)"
                        ></div>
                        <div
                            v-for="button in buttons"
                            :key="button.id"
                            class="button"
                            :class="{ visible: activeCircle === button.circle }"
                            :style="getButtonStyle(button)"
                        >
                            {{ button.text }}
                        </div>
                    </div>  
                    <div
                        class="bg-white p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px] text-center"
                    >
                        <p
                            className="BrandonGrotesque-Regular txt-anaranjado-fuerte text-3xl sm:text-3xl md:text-2xl lg:text-3xl xl:text-5xl"
                        >
                            QUINTUPLE HÉLICE
                        </p>
                        <p
                            className="roboto-condensed-semibold txt-azul text-3xl sm:text-3xl md:text-2xl lg:text-3xl xl:text-5xl"
                        >
                            Trabajamos con todos los actores del ecosistema
                        </p>
                        <div class="bg-white">
                            <img
                                class="w-full h-auto mx-auto object-cover"
                                :src="quintuple_elice"
                            />
                        </div>
                    </div>
                    <div
                        class="bg-white p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px] text-center"
                    >
                        <p
                            className="BrandonGrotesque-Regular txt-anaranjado-fuerte text-5xl sm:text-5xl md:text-4xl lg:text-5xl xl:text-7xl"
                        >
                            HUB DE INNOVACIÓN
                        </p>
                        <p
                            className="roboto-condensed-semibold txt-azul text-3xl sm:text-3xl md:text-2xl lg:text-3xl xl:text-5xl item"
                        >
                            Fortaleciendo la competitividad, el desarrollo
                            sostenible y la inclusión de las personas
                        </p>
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 items-center pt-10"
                        >
                            <div>
                                <img
                                    class="max-w-[30%] sm:max-w-[30%] md:max-w-[50%] lg:max-w-[80%] xl:max-w-[60%] h-auto mx-auto"
                                    :src="open_innovacion"
                                />
                            </div>
                            <div>
                                <p
                                    class="pt-10 pb-10 roboto-condensed-semibold txt-azul text-xl sm:text-xl md:text-1xl lg:text-2xl xl:text-4xl text-justify"
                                >
                                    Este es un programa de innovación de NINARI
                                    Foundation, para promover procesos
                                    innovadores articulando al ecosistema para
                                    encontrar soluciones que involucran I+D+i.
                                    Estos eventos contribuirán al incremento de
                                    la capacidad investigativa y a la creación
                                    de redes CTI sostenibles, como parte de un
                                    MACROPROYECTO que impulsa la articulación y
                                    la colaboración como herramientas del
                                    desarrollo sostenible
                                </p>
                            </div>
                        </div>
                        <div
                            class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 items-center pt-10"
                        >
                            <div>
                                <img
                                    class="max-w-[50%] sm:max-w-[50%] md:max-w-[50%] lg:max-w-[80%] xl:max-w-[60%] h-auto mx-auto"
                                    :src="iste"
                                />
                                <p
                                    class="pt-10 pb-10 roboto-condensed-semibold txt-gray-900 text-lg sm:text-xl md:text-1xl lg:text-2xl xl:text-4xl text-center"
                                >
                                    LABORATORIO INNOVACIÓN <br />
                                    PARA EL SECTOR SALUD
                                </p>
                            </div>
                            <div>
                                <img
                                    class="max-w-[50%] sm:max-w-[50%] md:max-w-[50%] lg:max-w-[80%] xl:max-w-[60%] h-auto mx-auto"
                                    :src="cuissine"
                                />
                                <p
                                    class="pt-10 pb-10 roboto-condensed-semibold txt-gray-900 text-lg sm:text-xl md:text-1xl lg:text-2xl xl:text-4xl text-center"
                                >
                                    LABORATORIO INNOVACIÓN <br />
                                    PARA EL SECTOR GASTRONÓMICO
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white">
                        <img
                            class="w-full h-auto mx-auto object-cover"
                            :src="iconoecosistema"
                        />
                    </div>
                    <div class="bg-azul-opaco h-[300px] rounded-b-30"></div>
                </div>
            </div>
        </div>
        <Footer></Footer>
    </div>
</template>
<style scoped>
.flotar {
    animation: flotar 3s ease-in-out infinite;
}
/**efecto flotacion */
@keyframes flotar {
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
.clickable-area {
  position: absolute;
  border-radius: 50%;
  cursor: pointer;
  z-index: 2;
}

.clickable-area::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border-radius: 50%;
  border: 4px solid rgba(255, 255, 255, 0.7);
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
  }
  
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
  }
  
  100% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
  }
}

.button {
  position: absolute;
  padding: 10px 15px;
  background-color: #f7941d;
  color: white;
  border-radius: 25px;
  font-weight: bold;
  text-align: center;
  opacity: 0;
  transition: opacity 0.3s ease, transform 0.3s ease;
  transform: scale(0.8);
  z-index: 3;
  white-space: nowrap;
  cursor: pointer;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.button.visible {
  opacity: 1;
  transform: scale(1);
}

.button:hover {
  transform: scale(1.05);
}

@media (max-width: 640px) {
  .button {
    font-size: 0.75rem;
    padding: 8px 12px;
  }
}

@media (min-width: 641px) and (max-width: 768px) {
  .button {
    font-size: 0.875rem;
    padding: 9px 13px;
  }
}
</style>

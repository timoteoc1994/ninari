<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import Menu from "@/Components/menu.vue";
import Footer from "@/Components/footer.vue";
const programas_personas = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas_personas.png`
);

const programa_activate = computed(
    () =>
        `${
            import.meta.env.VITE_APP_URL
        }/storage/programas/programa_activate.png`
);
const logo_activa_crece = computed(
    () =>
        `${
            import.meta.env.VITE_APP_URL
        }/storage/programas/logo_activa_crece.png`
);
const ayuda_accion = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/ayuda_accion.png`
);

const programa_super_heroes = computed(
    () =>
        `${
            import.meta.env.VITE_APP_URL
        }/storage/programas/programa_super_heroes.png`
);

const super_heroes = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/super_heroes.png`
);
const labxxi = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/labxxi.png`
);

const programa_crisfe = computed(
    () =>
        `${import.meta.env.VITE_APP_URL}/storage/programas/programa_crisfe.png`
);
const crisfe = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/crisfe.png`
);

const programa_artesana = computed(
    () =>
        `${
            import.meta.env.VITE_APP_URL
        }/storage/programas/programa_artesana.png`
);
const artesana = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/artesana.png`
);
const hgpt = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/hgpt.png`
);
const mit = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/mit.png`
);
const movimiento_indigena = computed(
    () =>
        `${
            import.meta.env.VITE_APP_URL
        }/storage/programas/movimiento_indigena.png`
);
const programa_woccu = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/programa_woccu.png`
);
const woocu = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/woocu.png`
);

const programa_women = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/programa_women.png`
);
const women = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/women.png`
);
const cipt = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados/cipt@3x.png`
);
const gizalemania = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados/gizalemania@3x.png`
);

const programa_tfw = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/programa_tfw.png`
);
const tfw = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/tfw.png`
);

const programa_open = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/programa_open.png`
);
const iste = computed(() => `${import.meta.env.VITE_APP_URL}/storage/iste.png`);
const open_innovacion = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/open_innovacion.png`
);
const ecuador_resuelve = computed(
    () =>
        `${import.meta.env.VITE_APP_URL}/storage/programas/ecuador_resuelve.png`
);
const cruz_roja = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/cruz_roja.png`
);
const programa_conexion = computed(
    () =>
        `${
            import.meta.env.VITE_APP_URL
        }/storage/programas/programa_conexion.png`
);
const conexion = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/conexion@3x.png`
);
const speedy = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/speedy.png`
);
const programa_hgpt = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/programa_hgpt.png`
);
const diseño_desarrollo = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/diseño_desarrollo.JPEG`
);
const diseño_programacion = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas/diseño_programacion.JPEG`
);
</script>

<template>
    <Head title="Programas" />
    <div class="bg-gris relative">
        <!-- Contenido -->
        <div class="pt-6 pb-6">
            <Menu> </Menu>
            <div class="w-11/12 m-auto">
                <div class="">
                    <div class="bg-rosado-raro rounded-t-30">
                        <div
                            class="pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px] pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[0px]"
                        >
                            <div
                                class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 items-center"
                            >
                                <div>
                                    <p
                                        className="brandonGrotesque-regular txt-azul text-3xl sm:text-3xl md:text-2xl lg:text-3xl xl:text-5xl"
                                    >
                                        PROGRAMAS INNOVADORES
                                    </p>
                                    <p
                                        className="brandonGrotesque-regular text-white text-3xl sm:text-3xl md:text-2xl lg:text-3xl xl:text-5xl"
                                    >
                                        que construyen el ecosistema de
                                    </p>

                                    <p
                                        className="brandonGrotesque-regular txt-azul text-7xl sm:text-8xl md:text-4xl lg:text-5xl xl:text-9xl animate-impact"
                                    >
                                        IMPACTO
                                    </p>
                                    <p
                                        className="brandonGrotesque-regular text-white text-3xl sm:text-3xl md:text-2xl lg:text-3xl xl:text-5xl"
                                    >
                                        en todas las regiones de Ecuador
                                    </p>
                                </div>
                                <div class="pt-10">
                                    <img
                                        class="w-full h-auto mx-auto object-cover"
                                        :src="programas_personas"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white">
                        <div class="relative">
                            <!-- Imagen -->
                            <div>
                                <img
                                    class="w-full h-auto mx-auto object-cover"
                                    :src="programa_activate"
                                />
                            </div>

                            <!-- Texto encima de la imagen (abajo) -->
                            <div
                                class="absolute bottom-[5%] left-0 right-0 p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                            >
                                <p
                                    class="roboto-condensed-semibold text-white [text-shadow:_0_8px_8px_rgb(0,0,0,0.8)] text-xl sm:text-3xl md:text-3xl lg:text-4xl xl:text-5xl"
                                >
                                    Programa de emprendimiento e innovación para
                                    personas en situación de movilidad humana
                                    IMBABURA - AYUDA EN ACCIÓN
                                </p>
                            </div>
                        </div>
                        <div>
                            <div
                                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 pt-5 pb-5 items-center"
                            >
                                <div>
                                    <img
                                        class="max-w-[50%] sm:max-w-[50%] md:max-w-[50%] lg:max-w-[50%] xl:max-w-[30%] h-auto pl-5"
                                        :src="logo_activa_crece"
                                    />
                                </div>
                                <div class="flex justify-end">
                                    <img
                                        class="max-w-[80%] sm:max-w-[80%] md:max-w-[60%] lg:max-w-[80%] xl:max-w-[60%] h-auto pr-5"
                                        :src="ayuda_accion"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white">
                        <div class="relative">
                            <!-- Imagen -->
                            <div>
                                <img
                                    class="w-full h-auto mx-auto object-cover"
                                    :src="programa_super_heroes"
                                />
                            </div>

                            <!-- Texto encima de la imagen (abajo) -->
                            <div
                                class="absolute bottom-[5%] left-0 right-0 p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                            >
                                <p
                                    class="roboto-condensed-semibold text-white [text-shadow:_0_8px_8px_rgb(0,0,0,0.8)] text-xl sm:text-3xl md:text-3xl lg:text-4xl xl:text-5xl"
                                >
                                    Programa de empredimiento y habilidades
                                    blandas para adolescentes “Super Héroes”
                                    CHIMBORAZO Y LOS RÍOS - LAB XXI
                                </p>
                            </div>
                        </div>
                        <div>
                            <div
                                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 pt-5 items-center"
                            >
                                <div>
                                    <img
                                        class="max-w-[50%] sm:max-w-[50%] md:max-w-[50%] lg:max-w-[50%] xl:max-w-[30%] h-auto pl-5"
                                        :src="super_heroes"
                                    />
                                </div>
                                <div class="flex justify-end">
                                    <img
                                        class="max-w-[30%] sm:max-w-[30%] md:max-w-[30%] lg:max-w-[30%] xl:max-w-[20%] h-auto pr-5"
                                        :src="labxxi"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white">
                        <div class="relative">
                            <!-- Imagen -->
                            <div>
                                <img
                                    class="w-full h-auto mx-auto object-cover"
                                    :src="programa_crisfe"
                                />
                            </div>

                            <!-- Texto encima de la imagen (abajo) -->
                            <div
                                class="absolute bottom-[5%] left-0 right-0 p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                            >
                                <p
                                    class="roboto-condensed-semibold text-white [text-shadow:_0_8px_8px_rgb(0,0,0,0.8)] text-xl sm:text-3xl md:text-3xl lg:text-4xl xl:text-5xl"
                                >
                                    Estudio y validación de programas de
                                    educación e inclusión financiera,
                                    corresponsales bancarios NACIONAL - CRISFE
                                </p>
                            </div>
                        </div>
                        <div>
                            <div
                                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 pt-5 pb-5 items-center"
                            >
                                <div></div>
                                <div class="flex justify-end">
                                    <img
                                        class="max-w-[50%] sm:max-w-[50%] md:max-w-[50%] lg:max-w-[50%] xl:max-w-[50%] h-auto pr-5"
                                        :src="crisfe"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white">
                        <div class="relative">
                            <!-- Imagen -->
                            <div>
                                <img
                                    class="w-full h-auto mx-auto object-cover"
                                    :src="programa_artesana"
                                />
                            </div>

                            <!-- Texto encima de la imagen (abajo) -->
                            <div
                                class="absolute bottom-[5%] left-0 right-0 p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                            >
                                <p
                                    class="roboto-condensed-semibold text-white [text-shadow:_0_8px_8px_rgb(0,0,0,0.8)] text-xl sm:text-3xl md:text-3xl lg:text-4xl xl:text-5xl"
                                >
                                    Programa de recuperación de oficios
                                    artesanales, innovación y sostenibilidad,
                                    saberes interculturales UNIDAD MOVIMIENTOS
                                    INDÍGENAS DE TUNGURAHUA
                                </p>
                            </div>
                        </div>
                        <div>
                            <div
                                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 pt-5 pb-5 items-center"
                            >
                                <div>
                                    <img
                                        class="max-w-[30%] sm:max-w-[30%] md:max-w-[30%] lg:max-w-[30%] xl:max-w-[20%] h-auto pl-5"
                                        :src="artesana"
                                    />
                                </div>
                                <div class="flex justify-end">
                                    <img
                                        class="max-w-[40%] sm:max-w-[40%] md:max-w-[40%] lg:max-w-[40%] xl:max-w-[40%] h-auto pr-5"
                                        :src="hgpt"
                                    />
                                    <img
                                        class="max-w-[30%] sm:max-w-[30%] md:max-w-[30%] lg:max-w-[30%] xl:max-w-[20%] h-auto pr-5"
                                        :src="mit"
                                    />
                                    <img
                                        class="max-w-[30%] sm:max-w-[30%] md:max-w-[30%] lg:max-w-[30%] xl:max-w-[20%] h-auto pr-5"
                                        :src="movimiento_indigena"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white">
                        <div class="relative">
                            <!-- Imagen -->
                            <div>
                                <img
                                    class="w-full h-auto mx-auto object-cover"
                                    :src="programa_woccu"
                                />
                            </div>

                            <!-- Texto encima de la imagen (abajo) -->
                            <div
                                class="absolute bottom-[5%] left-0 right-0 p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                            >
                                <p
                                    class="roboto-condensed-semibold text-white [text-shadow:_0_8px_8px_rgb(0,0,0,0.8)] text-xl sm:text-3xl md:text-3xl lg:text-4xl xl:text-5xl"
                                >
                                    Programa de Incubación emprendedoras,
                                    inclusión económica movilidad humana AZUAY -
                                    WOCCU ECUADOR
                                </p>
                            </div>
                        </div>
                        <div>
                            <div
                                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 pt-5 pb-5 items-center"
                            >
                                <div></div>
                                <div class="flex justify-end">
                                    <img
                                        class="max-w-[50%] sm:max-w-[50%] md:max-w-[50%] lg:max-w-[40%] xl:max-w-[40%] h-auto pr-5"
                                        :src="woocu"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Programa women-->
                    <div class="bg-white">
                        <div class="relative">
                            <!-- Imagen -->
                            <div>
                                <img
                                    class="w-full h-auto mx-auto object-cover"
                                    :src="programa_women"
                                />
                            </div>

                            <!-- Texto encima de la imagen (abajo) -->
                            <div
                                class="absolute bottom-[5%] left-0 right-0 p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                            >
                                <p
                                    class="roboto-condensed-semibold text-white [text-shadow:_0_8px_8px_rgb(0,0,0,0.8)] text-xl sm:text-3xl md:text-3xl lg:text-4xl xl:text-5xl"
                                >
                                    WOMEN innovation Lab, potenciando una red de
                                    mujeres empresarias en STEM SIERRA CENTRO
                                    ECUADOR - CIPT GIZ ECUADOR
                                </p>
                            </div>
                        </div>
                        <div>
                            <div
                                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 pt-5 pb-5 items-center"
                            >
                                <div>
                                    <img
                                        class="max-w-[40%] sm:max-w-[30%] md:max-w-[30%] lg:max-w-[30%] xl:max-w-[25%] h-auto pl-5"
                                        :src="women"
                                    />
                                </div>
                                <div class="flex justify-end">
                                    <img
                                        class="max-w-[50%] sm:max-w-[50%] md:max-w-[50%] lg:max-w-[40%] xl:max-w-[30%] h-auto pr-5"
                                        :src="cipt"
                                    />
                                    <img
                                        class="max-w-[70%] sm:max-w-[70%] md:max-w-[70%] lg:max-w-[70%] xl:max-w-[40%] h-auto pr-5"
                                        :src="gizalemania"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Programa tfw-->

                    <div class="bg-white">
                        <div class="relative">
                            <!-- Imagen -->
                            <div>
                                <img
                                    class="w-full h-auto mx-auto object-cover"
                                    :src="programa_tfw"
                                />
                            </div>

                            <!-- Texto encima de la imagen (abajo) -->
                            <div
                                class="absolute bottom-[5%] left-0 right-0 p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                            >
                                <p
                                    class="roboto-condensed-semibold text-white [text-shadow:_0_8px_8px_rgb(0,0,0,0.8)] text-xl sm:text-3xl md:text-3xl lg:text-4xl xl:text-5xl"
                                >
                                    Programa de Innovación, desarrollo de
                                    colección y acceso a mercado SECTORES CUERO,
                                    CALZADO Y TEXTIL -TUNGURAHUA
                                </p>
                            </div>
                        </div>
                        <div>
                            <div
                                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 pt-5 pb-5 items-center"
                            >
                                <div>
                                    <img
                                        class="max-w-[40%] sm:max-w-[30%] md:max-w-[30%] lg:max-w-[30%] xl:max-w-[25%] h-auto pl-5"
                                        :src="tfw"
                                    />
                                </div>
                                <div class="flex justify-end">
                                    <img
                                        class="max-w-[50%] sm:max-w-[50%] md:max-w-[50%] lg:max-w-[40%] xl:max-w-[30%] h-auto pr-5"
                                        :src="hgpt"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--programa open-->
                    <div class="bg-white">
                        <div class="relative">
                            <!-- Imagen -->
                            <div>
                                <img
                                    class="w-full h-auto mx-auto object-cover"
                                    :src="programa_open"
                                />
                            </div>

                            <!-- Texto encima de la imagen (abajo) -->
                            <div
                                class="absolute bottom-[5%] left-0 right-0 p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                            >
                                <p
                                    class="roboto-condensed-semibold text-white [text-shadow:_0_8px_8px_rgb(0,0,0,0.8)] text-xl sm:text-3xl md:text-3xl lg:text-4xl xl:text-5xl"
                                >
                                    Programa de Innovación Abierta para el
                                    sector salud <br />
                                    TUNGURAHUA - ISTE
                                </p>
                            </div>
                        </div>
                        <div>
                            <div
                                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 pt-5 pb-5 items-center"
                            >
                                <div>
                                    <img
                                        class="max-w-[40%] sm:max-w-[50%] md:max-w-[30%] lg:max-w-[30%] xl:max-w-[25%] h-auto pl-5"
                                        :src="open_innovacion"
                                    />
                                </div>
                                <div class="flex justify-end">
                                    <img
                                        class="max-w-[40%] sm:max-w-[40%] md:max-w-[40%] lg:max-w-[40%] xl:max-w-[30%] h-auto object-contain"
                                        :src="iste"
                                    />
                                    <img
                                        class="max-w-[40%] sm:max-w-[25%] md:max-w-[25%] lg:max-w-[25%] xl:max-w-[25%] h-auto object-contain"
                                        :src="ecuador_resuelve"
                                    />
                                    <img
                                        class="max-w-[50%] sm:max-w-[50%] md:max-w-[50%] lg:max-w-[40%] xl:max-w-[30%] h-auto pr-5"
                                        :src="cruz_roja"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    




                    <div class="bg-white">
                        <div class="relative">
                            <!-- Imagen -->
                            <div>
                                <img
                                    class="w-full h-auto mx-auto object-cover"
                                    :src="diseño_desarrollo"
                                />
                            </div>

                            <!-- Texto encima de la imagen (abajo) -->
                            <div
                                class="absolute bottom-[5%] left-0 right-0 p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                            >
                                <p
                                    class="roboto-condensed-semibold text-white [text-shadow:_0_8px_8px_rgb(0,0,0,0.8)] text-xl sm:text-3xl md:text-3xl lg:text-4xl xl:text-5xl"
                                >
                                    DISEÑO Y DESARROLLO DE UNA APLICACIÓN 
                                    MÓVIL Y PLATAFORMA WEB DE RECICLAJE EN 
                                    EL PROYECTO APPEDAL PARA RECICLADORAS DE 
                                    BASE CON INNOVACIÓN Y TECNOLOGÍA.
                                </p>
                            </div>
                        </div>
                        <div>
                            <div
                                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 pt-5 pb-5 items-center"
                            >
                                <div>
                                    <img
                                        class="max-w-[40%] sm:max-w-[30%] md:max-w-[30%] lg:max-w-[30%] xl:max-w-[25%] h-auto pl-5"
                                        :src="tfw"
                                    />
                                </div>
                                <div class="flex justify-end">
                                    <img
                                        class="max-w-[50%] sm:max-w-[50%] md:max-w-[50%] lg:max-w-[40%] xl:max-w-[30%] h-auto pr-5"
                                        :src="Coica"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="bg-white">
                        <div class="relative">
                            <!-- Imagen -->
                            <div>
                                <img
                                    class="w-full h-auto mx-auto object-cover"
                                    :src="diseño_programacion"
                                />
                            </div>

                            <!-- Texto encima de la imagen (abajo) -->
                            <div
                                class="absolute bottom-[5%] left-0 right-0 p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                            >
                                <p
                                    class="roboto-condensed-semibold text-white [text-shadow:_0_8px_8px_rgb(0,0,0,0.8)] text-xl sm:text-3xl md:text-3xl lg:text-4xl xl:text-5xl"
                                >
                                    DISEÑO Y PROGRAMACIÓN DE LA PLATAFORMA DE PROMOCIÓN 
                                    DE EMPRENDIMIENTOS Y REPOSITORIOS DIGITAL DE CONOCIMIENTOS 
                                    ANCESTRALES.
                                </p>
                            </div>
                        </div>
                        <div>
                            <div
                                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 pt-5 pb-5 items-center"
                            >
                                <div>
                                    <img
                                        class="max-w-[40%] sm:max-w-[30%] md:max-w-[30%] lg:max-w-[30%] xl:max-w-[25%] h-auto pl-5"
                                        :src="Coica"
                                    />
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    




                    


                    

                    
                    <div class="bg-azul-opaco rounded-b-30">
                        <div
                            class="p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                        >
                            <div
                                class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 items-end"
                            >
                                <div>
                                    <p
                                        className="brandonGrotesque-regular text-white text-3xl sm:text-4xl md:text-3xl lg:text-3xl xl:text-4xl"
                                    >
                                        PROYECTOS NINARI FOUNDATION
                                    </p>

                                    <p
                                        className="brandonGrotesque-regular txt-azul text-5xl sm:text-5xl md:text-5xl lg:text-4xl xl:text-7xl"
                                    >
                                        EN ALIANZA
                                    </p>
                                    <p
                                        className="brandonGrotesque-regular text-white text-3xl sm:text-3xl md:text-3xl lg:text-3xl xl:text-4xl"
                                    >
                                        con el ecosistema empresarial y de
                                        innovación
                                    </p>
                                    <p
                                        className="brandonGrotesque-regular txt-azul text-5xl sm:text-5xl md:text-5xl lg:text-5xl xl:text-7xl"
                                    >
                                        DEL ECUADOR
                                    </p>
                                </div>
                                <div class="">
                                    <p
                                        className="brandonGrotesque-regular text-white text-5xl sm:text-5xl md:text-5xl lg:text-5xl xl:text-7xl text-center"
                                    >
                                        2024-2025
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Footer></Footer>
    </div>
</template>
<style>
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
</style>

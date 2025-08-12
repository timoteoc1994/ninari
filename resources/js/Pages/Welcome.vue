<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import Menu from "@/Components/menu.vue";
import Footer from "@/Components/footer.vue";

const recursoe = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/recurso2.png`
);
const recurso4 = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/recurso4.png`
);
const personas = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/personas.png`
);
const boton_nosotros = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/botonnosotros.png`
);
const imagen1_desarrollo_sostenible = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/Recurso 9@3x.png`
);
const imagen2_desarrollo_sostenible = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/Recurso 8@3x.png`
);
const imagen3_desarrollo_sostenible = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/Recurso 7@3x.png`
);
const imagen4_desarrollo_sostenible = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/Recurso 10@3x.png`
);
const boton_programas = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/Recurso 3@3x.png`
);
const innovacion11 = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/innovacion11.png`
);
const innovacion22 = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/innovacion22.png`
);
const innovacion33 = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/innovacion33.png`
);
const derechos1 = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/derechos1.png`
);
const derechos2 = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/derechos2.png`
);
const derechos3 = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/derechos3.png`
);
const renarec = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados/renarec.jpg`
);
const iste = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/iste.png`
);
const camara_de_comercio = computed(
    () =>
        `${
            import.meta.env.VITE_APP_URL
        }/storage/aliados/camara_de_comercio@3x.png`
);
const cipt = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados/cipt@3x.png`
);
const gizalemania = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados/gizalemania@3x.png`
);
const honorable = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados/honorable@3x.png`
);
const labxxi = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados/labxxi@3x.png`
);
const solca = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados/solca@3x.png`
);
const speedy = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados/speedy@3x.png`
);
const ayuda_en_accion = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados/ayuda_en_accion.png`
);
const aliados = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados/aliados@3x.png`
);
const aliados_fondo = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/aliados_fondo.png`
);
const personas_aliados = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/personas_aliados.png`
);
const logo_ninari_colores = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/logo_ninari_colores.png`
);
</script>

<template>
    <Head title="Inicio" />

    

    <div class="bg-gris relative">
        <!-- Imagen superpuesta -->
        <div
            class="absolute inset-0 z-0 hidden sm:hidden md:block"
            :style="{
                backgroundImage: `url(${recursoe})`,
                backgroundSize: '50%',
                backgroundPosition: 'calc(100% - 80px) top',
                backgroundRepeat: 'no-repeat',
            }"
        ></div>
        <!-- Contenido -->
        <div class="pt-6 pb-6">
            <Menu> </Menu>
            <div class="w-11/12 m-auto">
                <div class="bg-white rounded-t-30">
                    <div
                        class="grid grid-cols-12 h-150 p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                    >
                        <div
                            class="relative col-span-12 md:col-span-12 xl:col-span-6 lg:col-span-6"
                        >
                            <div class="interlineado-pequeno fade-enter animate-fadeInUp ">
                                <p
                                    class="brandonGrotesque-regular txt-anaranjado text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl"
                                >
                                    INNOVACIÓN y
                                </p>
                                <p
                                    class="brandonGrotesque-regular txt-azul text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl"
                                >
                                    DESARROLLO
                                </p>
                                <p
                                    class="brandonGrotesque-regular text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl txt-anaranjado"
                                >
                                    sostenible
                                </p>
                            </div>

                            <div class="pt-10 animate-fadeInUp ">
                                <p
                                    class="roboto-condensed-semibold text-justify text-xl sm:text-1xl md:text-xl lg:text-3xl xl:text-3xl txt-azul"
                                >
                                    Organización privada sin fines de lucro,
                                    conectamos a los actores del ecosistema de
                                    innovación para impulsar el desarrollo
                                    socioeconómico sostenible en Ecuador.
                                </p>
                            </div>
                            <div class="pt-10 animate-fadeInUp ">
                                <p
                                    class="roboto-condensed-semibold text-justify text-xl sm:text-1xl md:text-xl lg:text-3xl xl:text-3xl txt-azul"
                                >
                                    Utilizando la innovación social, productiva
                                    y comercial, NINARI busca resolver problemas
                                    y potenciar oportunidades, creando regiones
                                    más inclusivas, competitivas y sostenibles.
                                </p>
                            </div>
                        </div>
                        <div
                            class="relative col-span-12 md:col-span-12 xl:col-span-6 lg:col-span-6 flex justify-center items-center pt-4"
                        >
                            <img
                                class="flotar max-w-[90%] sm:max-w-[80%] md:max-w-[70%] lg:max-w-[85%] xl:max-w-[80%] h-auto"
                                :src="recurso4"
                            />
                        </div>
                    </div>
                </div>
                <div class="bg-custom-gradient">
                    <!-- Articulacion-->
                    <div
                        class="grid grid-cols-12 h-150 pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px]"
                    >
                        <div
                            class="relative col-span-12 md:col-span-12 xl:col-span-6 lg:col-span-6"
                        >
                            <div class="interlineado-pequeno animate-fadeInUp ">
                                <p
                                    class="brandonGrotesque-regular text-white text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl"
                                >
                                    articulamos
                                </p>
                                <p
                                    class="brandonGrotesque-regular txt-anaranjado-fuerte text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl"
                                >
                                    ECOSISTEMAS
                                </p>
                                <p
                                    class="brandonGrotesque-regular text-white text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl"
                                >
                                    creamos
                                </p>
                                <p
                                    class="brandonGrotesque-regular txt-anaranjado-fuerte text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl"
                                >
                                    PROGRAMAS
                                </p>
                                <p
                                    class="brandonGrotesque-regular text-white text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl"
                                >
                                    de vanguardia
                                </p>
                            </div>

                            <div class="pt-10 animate-fadeInUp ">
                                <p
                                    class="roboto-condensed-semibold text-justify text-xl sm:text-1xl md:text-xl lg:text-3xl xl:text-3xl text-white pr-[40px]"
                                >
                                    NINARI actúa como una articuladora del
                                    ecosistema de innovación y mercado para
                                    impulsar el desarrollo de programas
                                    empresariales y educativos de vanguardia.
                                    También se dedica a construir estrategias de
                                    integración de cadenas de valor en sectores
                                    de alta especialización, colaborar en el
                                    desarrollo regional y mejorar la calidad de
                                    vida en comunidades vulnerables.
                                </p>
                            </div>
                            <div class="flex justify-center pt-10 animate-fadeInUp ">
                                <Link :href="route('nosotros')">
                                    <img
                                        class="max-w-[30%] sm:max-w-[40%] md:max-w-[30%] lg:max-w-[40%] xl:max-w-[30%] h-auto transition-transform duration-300 ease-in-out hover:scale-110"
                                        :src="boton_nosotros"
                                        alt=""
                                    />
                                </Link>
                            </div>
                        </div>
                        <div
                            class="col-span-12 md:col-span-12 xl:col-span-6 lg:col-span-6 flex justify-end flotar"
                        >
                            <img
                                class="object-contain"
                                :src="personas"
                            />
                        </div>
                    </div>
                    <!--desarrollo sostenible-->
                    <div
                        class="pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px]"
                    >
                        <div class="">
                            <div class="interlineado-pequeno animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular text-white text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl"
                                >
                                    DESAROLLO SOSTENIBLE
                                </p>
                            </div>
                        </div>
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4 pt-100 pb-10 pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[90px]"
                        >
                            <div class="text-center animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    construcción de
                                </p>
                                <p
                                    class="brandonGrotesque-regular txt-anaranjado text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    ECOSISTEMAS
                                </p>
                                <img
                                    class="max-w-[30%] sm:max-w-[40%] md:max-w-[30%] lg:max-w-[40%] xl:max-w-[40%] h-auto pt-70 mx-auto acercar"
                                    :src="imagen1_desarrollo_sostenible"
                                    alt=""
                                />
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl pt-70 pl-10 pr-10"
                                >
                                    Fomentamos la creación y fortalecimiento de
                                    ecosistemas empresariales y de innovación
                                    que integren a diversos actores
                                </p>
                            </div>
                            <div class="text-center animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    industrias
                                </p>
                                <p
                                    class="brandonGrotesque-regular txt-anaranjado text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    l+D+i
                                </p>
                                <img
                                    class="max-w-[30%] sm:max-w-[40%] md:max-w-[30%] lg:max-w-[40%] xl:max-w-[40%] h-auto pt-10 mx-auto acercar"
                                    :src="imagen2_desarrollo_sostenible"
                                    alt=""
                                />
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl pt-70 pl-10 pr-10"
                                >
                                    Impulsamos la I+D+i en industrias clave,
                                    promoviendo la adopción de tecnologías
                                    avanzadas y prácticas sostenibles.
                                </p>
                            </div>
                            <div class="text-center animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular txt-anaranjado text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    .
                                </p>
                                <p
                                    class="brandonGrotesque-regular txt-anaranjado text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    EMPRENDIMIENTO
                                </p>
                                <img
                                    class="max-w-[30%] sm:max-w-[40%] md:max-w-[30%] lg:max-w-[40%] xl:max-w-[40%] h-auto pt-10 mx-auto acercar"
                                    :src="imagen3_desarrollo_sostenible"
                                    alt=""
                                />
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl pt-70 pl-10 pr-10"
                                >
                                    Apoyamos a emprendedores a través de
                                    programas de capacitación, mentoría,
                                    networking comercial y acceso a
                                    financiamiento.
                                </p>
                            </div>
                            <div class="text-center animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    economía
                                </p>
                                <p
                                    class="brandonGrotesque-regular txt-anaranjado text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    NARANJA
                                </p>
                                <img
                                    class="max-w-[30%] sm:max-w-[40%] md:max-w-[30%] lg:max-w-[40%] xl:max-w-[40%] h-auto pt-10 mx-auto acercar"
                                    :src="imagen4_desarrollo_sostenible"
                                    alt=""
                                />
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl pt-70 pl-10 pr-10"
                                >
                                    Promovemos las industrias culturales y
                                    creativas, reconociendo su potencial para
                                    generar empleo, ingresos y preservar la
                                    identidad cultural.
                                </p>
                            </div>
                        </div>
                        <div class="pt-10 relative">
                            <Link :href="route('programas')">
                            <img
                                class="max-w-[30%] sm:max-w-[30%] md:max-w-[30%] lg:max-w-[20%] xl:max-w-[15%] h-auto transition-transform duration-300 ease-in-out hover:scale-110"
                                :src="boton_programas"
                                alt=""
                            />
                            </Link>
                           
                        </div>
                    </div>
                </div>
                <div class="bg-anaranjado">
                    <div
                        class="pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px] pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[90px]"
                    >
                        <div class="">
                            <div class="interlineado-pequeno animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular text-white text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl"
                                >
                                    INNOVACIÓN
                                </p>
                            </div>
                        </div>
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-3 gap-4 pt-100 pb-10"
                        >
                            <div class="text-center animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    innovación
                                </p>
                                <p
                                    class="brandonGrotesque-regular txt-azul text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    SOCIAL
                                </p>
                                <img
                                    class="max-w-[30%] sm:max-w-[40%] md:max-w-[30%] lg:max-w-[40%] xl:max-w-[40%] h-auto pt-70 mx-auto acercar"
                                    :src="innovacion11"
                                    alt=""
                                />
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl pt-70 pl-10 pr-10"
                                >
                                    Fomentamos la creación y fortalecimiento de
                                    ecosistemas empresariales y de innovación
                                    que integren a diversos actores
                                </p>
                            </div>
                            <div class="text-center animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    innovación
                                </p>
                                <p
                                    class="brandonGrotesque-regular txt-azul text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    PRODUCTIVA
                                </p>
                                <img
                                    class="max-w-[30%] sm:max-w-[40%] md:max-w-[30%] lg:max-w-[40%] xl:max-w-[40%] h-auto pt-70 mx-auto acercar"
                                    :src="innovacion22"
                                    alt=""
                                />
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl pt-70 pl-10 pr-10"
                                >
                                    Impulsamos la I+D+i en industrias clave,
                                    promoviendo la adopción de tecnologías
                                    avanzadas y prácticas sostenibles.
                                </p>
                            </div>
                            <div class="text-center animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    innovación
                                </p>
                                <p
                                    class="brandonGrotesque-regular txt-azul text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    COMERCIAL
                                </p>
                                <img
                                    class="max-w-[30%] sm:max-w-[40%] md:max-w-[30%] lg:max-w-[40%] xl:max-w-[40%] h-auto pt-70 mx-auto acercar"
                                    :src="innovacion33"
                                    alt=""
                                />
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl pt-70 pl-10 pr-10"
                                >
                                    Apoyamos a emprendedores a través de
                                    programas de capacitación, mentoría,
                                    networking comercial y acceso a
                                    financiamiento.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-azul">
                    <div
                        class="pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px] pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[90px]"
                    >
                        <div class="">
                            <div class="interlineado-pequeno animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular text-white text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl text-end"
                                >
                                    DERECHOS Y PROTECCIÓN
                                </p>
                            </div>
                        </div>
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-3 gap-4 pt-100 pb-10"
                        >
                            <div class="text-center animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular txt-anaranjado-fuerte text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    GÉNERO
                                </p>
                                <img
                                    class="max-w-[40%] sm:max-w-[50%] md:max-w-[40%] lg:max-w-[50%] xl:max-w-[50%] h-auto pt-70 mx-auto acercar"
                                    :src="derechos1"
                                    alt=""
                                />
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl pt-70 pl-10 pr-10"
                                >
                                    Trabajamos para promover la igualdad de
                                    género en todos los ámbitos de la sociedad,
                                    asegurando las mismas oportunidades y
                                    recursos.
                                </p>
                            </div>
                            <div class="text-center animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular txt-anaranjado-fuerte text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    GENERACIONAL
                                </p>
                                <img
                                    class="max-w-[40%] sm:max-w-[50%] md:max-w-[40%] lg:max-w-[50%] xl:max-w-[50%] h-auto pt-70 mx-auto acercar"
                                    :src="derechos2"
                                    alt=""
                                />
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl pt-70 pl-10 pr-10"
                                >
                                    Fomentamos la participación activa de los
                                    jóvenes en el desarrollo económico y social,
                                    dándoles las herramientas y el apoyo
                                    necesario para que se conviertan en agentes
                                    de cambio.
                                </p>
                            </div>
                            <div class="text-center animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular txt-anaranjado-fuerte text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl"
                                >
                                    INTERCULTURALIDAD
                                </p>
                                <img
                                    class="max-w-[40%] sm:max-w-[50%] md:max-w-[40%] lg:max-w-[50%] xl:max-w-[50%] h-auto pt-70 mx-auto acercar"
                                    :src="derechos3"
                                    alt=""
                                />
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-2xl md:text-2xl lg:text-3xl xl:text-3xl pt-70 pl-10 pr-10"
                                >
                                    Promovemos el respeto y la valorización de
                                    la diversidad cultural, trabajando para
                                    construir una sociedad inclusiva donde todas
                                    las culturas y etnias sean reconocidas y
                                    respetadas.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-b-30 animate-fadeInUp">
                    <div
                        class="pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px] pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[90px]"
                    >
                        <div class="">
                            <div class="interlineado-pequeno">
                                <p
                                    class="brandonGrotesque-regular txt-azul text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl"
                                >
                                    ALIADOS
                                </p>
                            </div>
                            <div
                                class="grid grid-cols-12 h-150 pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px]"
                            >
                                <div
                                    class="relative col-span-12 md:col-span-12 xl:col-span-6 lg:col-span-6"
                                >
                                    <div
                                        class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5 items-center"
                                    >
                                        <img
                                            class="max-w-[90%] sm:max-w-[80%] md:max-w-[70%] lg:max-w-[90%] xl:max-w-[90%] h-auto transition-transform duration-300 ease-in-out hover:scale-105"
                                            :src="ayuda_en_accion"
                                            alt=""
                                        />
                                        <img
                                            class="max-w-[80%] sm:max-w-[80%] md:max-w-[50%] lg:max-w-[50%] xl:max-w-[50%] h-auto transition-transform duration-300 ease-in-out hover:scale-105"
                                            :src="labxxi"
                                            alt=""
                                        />
                                        <img
                                            class="max-w-[90%] sm:max-w-[80%] md:max-w-[50%] lg:max-w-[50%] xl:max-w-[50%] h-auto transition-transform duration-300 ease-in-out hover:scale-105"
                                            :src="cipt"
                                            alt=""
                                        />
                                        <img
                                            class="max-w-[90%] sm:max-w-[80%] md:max-w-[70%] lg:max-w-[90%] xl:max-w-[90%] h-auto transition-transform duration-300 ease-in-out hover:scale-105"
                                            :src="gizalemania"
                                            alt=""
                                        />
                                        <img
                                            class="max-w-[90%] sm:max-w-[80%] md:max-w-[70%] lg:max-w-[90%] xl:max-w-[90%] h-auto transition-transform duration-300 ease-in-out hover:scale-105"
                                            :src="speedy"
                                            alt=""
                                        />
                                        <img
                                            class="max-w-[90%] sm:max-w-[80%] md:max-w-[70%] lg:max-w-[90%] xl:max-w-[90%] h-auto transition-transform duration-300 ease-in-out hover:scale-105"
                                            :src="honorable"
                                            alt=""
                                        />
                                        <img
                                            class="max-w-[60%] sm:max-w-[60%] md:max-w-[50%] lg:max-w-[50%] xl:max-w-[50%] h-auto transition-transform duration-300 ease-in-out hover:scale-105"
                                            :src="solca"
                                            alt=""
                                        />
                                        <img
                                            class="max-w-[90%] sm:max-w-[80%] md:max-w-[70%] lg:max-w-[80%] xl:max-w-[80%] h-auto transition-transform duration-300 ease-in-out hover:scale-105"
                                            :src="iste"
                                            alt=""
                                        />
                                        <img
                                            class="max-w-[90%] sm:max-w-[80%] md:max-w-[70%] lg:max-w-[80%] xl:max-w-[80%] h-auto transition-transform duration-300 ease-in-out hover:scale-105"
                                            :src="renarec"
                                            alt=""
                                        />
                                        <img
                                            class="max-w-[90%] sm:max-w-[80%] md:max-w-[50%] lg:max-w-[50%] xl:max-w-[50%] h-auto  transition-transform duration-300 ease-in-out hover:scale-105"
                                            :src="camara_de_comercio"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <div
                                    class="col-span-12 md:col-span-12 xl:col-span-6 lg:col-span-6 flex justify-end items-center"
                                >
                                    <img
                                        class="max-w-[90%] sm:max-w-[80%] md:max-w-[70%] lg:max-w-[90%] xl:max-w-[90%] h-auto acercar"
                                        :src="aliados"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="-mt-[150px] left-0 w-full">
                            <div class="flex justify-end">
                                <img
                                    class="max-w-[90%] sm:max-w-[80%] md:max-w-[70%] lg:max-w-[90%] xl:max-w-[90%] h-auto rounded-b-30"
                                    :src="aliados_fondo"
                                />
                            </div>
                            <div
                                class="grid grid-cols-2 items-center absolute bottom-[-50px] left-0 w-full z-10"
                            >
                                <div>
                                    <img
                                        class="max-w-[90%] sm:max-w-[80%] md:max-w-[70%] lg:max-w-[90%] xl:max-w-[90%] h-auto rounded-b-30 flotar"
                                        :src="personas_aliados"
                                    />
                                </div>
                                <div>
                                    <img
                                        class="max-w-[30%] sm:max-w-[30%] md:max-w-[40%] lg:max-w-[40%] xl:max-w-[40%] mx-auto acercar"
                                        :src="logo_ninari_colores"
                                    />

                                    <p
                                        class="roboto-condensed-semibold txt-azul text-xs md:text-xl lg:text-3xl xl:text-3xl"
                                    >
                                        Catalizamos una transformación masiva,
                                        integramos saberes ancestrales
                                        vinculándolas con tecnologías
                                        emergentes.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative">
            <Footer></Footer>
        </div>
    </div>
</template>
<style scoped>


</style>

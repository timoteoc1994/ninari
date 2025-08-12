<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import Menu from "@/Components/menu.vue";
import Footer from "@/Components/footer.vue";
const imagen_nosotros = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/imagen_nosotros.png`
);

const foto_equipo = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/foto_equipo.png`
);
const fondo_proposito = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/fondo_proposito.png`
);
const proposito = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/proposito.png`
);
const proposito_senores = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/proposito_senores.png`
);
const boton_curriculo_vitae = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/boton_curriculo_vitae.png`
);
const valores_fondo = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/valores_fondo.png`
);
const valores_coherencia = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/valores_coherencia.png`
);

const Akapana = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/equipo/Akapana.jpg`
);
const Ruth = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/equipo/Ruth.jpg`
);
const Jose = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/equipo/Jose.jpg`
);
const Erika = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/equipo/Erika.jpg`
);
const Ingrid = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/equipo/Ingrid.jpg`
);
</script>

<template>
    <Head title="Ecosistema" />
    <div class="bg-gris relative">
        <!-- Contenido -->
        <div class="pt-6 pb-6">
            <Menu> </Menu>
            <div class="w-11/12 m-auto">
                <div class="relative">
                    <div class="bg_rosado rounded-t-30 relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 items-center p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                        >
                            <div class="text-center animate-fadeInUp">
                                <p
                                    class="brandonGrotesque-regular txt-azul text-3xl sm:text-3xl md:text-2xl lg:text-3xl xl:text-5xl"
                                >
                                    UN EQUIPO HUMANO
                                </p>
                                <p
                                    class="brandonGrotesque-regular text-3xl sm:text-3xl md:text-3xl lg:text-6xl xl:text-6xl text-white"
                                >
                                    dedicado a articular y servir a
                                </p>
                                <p
                                    class="brandonGrotesque-regular txt-azul text-3xl sm:text-3xl md:text-2xl lg:text-6xl xl:text-5xl"
                                >
                                    LOS ACTORES DEL
                                </p>
                                <p
                                    class="brandonGrotesque-regular text-3xl sm:text-3xl md:text-3xl lg:text-6xl xl:text-6xl text-white"
                                >
                                    ecosistema del Ecuador
                                </p>
                            </div>
                            <div class="z-0 sm:z-10 md:z-10 lg:z-10 xl:z-10">
                                <img
                                    class="flotar max-w-[90%] sm:max-w-[80%] md:max-w-[100%] lg:max-w-[100%] xl:max-w-[100%] h-auto mx-auto sm:pt-10"
                                    :src="imagen_nosotros"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="md:-mt-40 lg:-mt-20 xl:-mt-40 relative z-9 ">
                        <img
                            class="w-full h-auto mx-auto object-cover zoom"
                            :src="foto_equipo"
                        />
                    </div>
                    <div class="bg-azul-opaco">
                        <div
                            class="pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px] pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[90px]"
                        >
                            <div class="">
                                <div class="interlineado-pequeno">
                                    <p
                                        class="brandonGrotesque-regular text-white text-3xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-6xl"
                                    >
                                        construimos un país
                                    </p>
                                    <p
                                        class="brandonGrotesque-regular txt-anaranjado-fuerte text-2xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-5xl"
                                    >
                                        RESILIENTE, SOSTENIBLE E INNOVADOR
                                    </p>
                                </div>
                            </div>
                            <div class="pt-10 pb-10">
                                <p
                                    class="pt-10 roboto-condensed-semibold text-white text-xl sm:text-xl md:text-3xl lg:text-4xl xl:text-4xl text-justify"
                                >
                                    La Fundación Ninari para la innovación y el
                                    desarrollo sostenible, creada en 2023, en
                                    Ecuador, de forma que se contribuya al
                                    desarrollo de la economía local y nacional
                                    mediante la participación activa y
                                    concertada de todos los actores sociales, en
                                    especial de los gobiernos locales,
                                    empresarios, universidades, dirigentes
                                    comunitarios y políticos.
                                </p>

                                <p
                                    class="pt-10 roboto-condensed-semibold text-white text-xl sm:text-xl md:text-3xl lg:text-4xl xl:text-4xl text-justify"
                                >
                                    NINARI tiene por objeto la articulación,
                                    direccionamiento, participación,
                                    coordinación, consolidación, impulso a la
                                    innovación y el desarrollo sostenible de los
                                    territorios locales, nacionales y
                                    regionales, dentro de una política de
                                    desarrollo socio económico sostenible,
                                    equitativo, y humano de la República del
                                    Ecuador; incluyendo su incidencia en nuevas
                                    formas de desarrollo tecnológico, así como
                                    sus actividades complementarias y conexas
                                    propias de cada sector, mediante la
                                    concertación de actores públicos, privados,
                                    academia, y sociedad civil.
                                </p>

                                <p
                                    class="pt-10 pb-10 roboto-condensed-semibold text-white text-xl sm:text-xl md:text-3xl lg:text-4xl xl:text-4xl text-justify"
                                >
                                    Nuestro propósito es inspirar acciones con
                                    cada sector económico del Ecuador y su área
                                    de influencia para construir un territorio
                                    resiliente, sostenible e innovador.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="relative bg-white">
                        <div
                            class="relative hidden sm:hidden md:block lg:block xl:block"
                        >
                            <img
                                class="w-full h-auto mx-auto object-cover"
                                :src="fondo_proposito"
                            />
                        </div>
                        <div
                            class="md:absolute top-0 pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px] pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[90px]"
                        >
                            <div
                                class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2"
                            >
                                <div>
                                    <img
                                        class="flotar max-w-[90%] sm:max-w-[80%] md:max-w-[60%] lg:max-w-[80%] xl:max-w-[60%] h-auto"
                                        :src="proposito"
                                    />
                                    <img
                                        class="max-w-[90%] sm:max-w-[80%] md:max-w-[80%] lg:max-w-[70%] xl:max-w-[80%] h-auto"
                                        :src="proposito_senores"
                                    />
                                </div>
                                <div class="flex items-center">
                                    <p
                                        class="pt-10 pb-10 roboto-condensed-semibold txt-azul text-xl sm:text-xl md:text-1xl lg:text-2xl xl:text-4xl text-justify"
                                    >
                                        Identificar y conectar a los actores del
                                        ecosistema de innovación para impulsar
                                        el desarrollo socioeconómico sostenible
                                        en Ecuador y la región andina;
                                        utilizando la innovación social,
                                        productiva y comercial, resolvemos
                                        problemas y potenciamos oportunidades,
                                        catalizamos el cambio creando regiones
                                        más inclusivas, competitivas y
                                        sostenibles.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg_rosado">
                        <div
                            class="pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px] pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[90px]"
                        >
                            <div class="">
                                <div class="interlineado-pequeno">
                                    <p
                                        class="brandonGrotesque-regular txt-azul text-2xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-5xl"
                                    >
                                        EQUIPO
                                    </p>
                                </div>
                            </div>
                            <div
                                class="pt-10 pb-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5"
                            >
                                <div class="flex items-center">
                                    <p
                                        class="pt-10 pb-10 roboto-condensed-semibold txt-azul-fuerte text-xl sm:text-xl md:text-1xl lg:text-2xl xl:text-4xl text-justify md:pr-10 md:mr-10"
                                    >
                                        Para cumplir nuestra misión, necesitamos
                                        un equipo diverso y con múltiples
                                        talentos. Buscamos pensadores
                                        estratégicos que se basen en la
                                        evidencia, sean compasivos, valientes y
                                        curiosos.
                                    </p>
                                </div>
                                <div>
                                    
                                    <div
                                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto"
                                    >
                                        <!-- Miembro 1 -->
                                         <a href="https://www.linkedin.com/in/akapana-yantalema/" target="_blank">
                                        <div
                                            class="relative group aspect-[2.6/3.9] rounded-[30px] overflow-hidden bg-white shadow-lg"
                                        >
                                            <img
                                                :src="Akapana"
                                                alt="Ana García"
                                                class="absolute inset-0 w-full h-full object-contain scale-105 transition-transform duration-500 group-hover:scale-110"
                                            />
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6"
                                            >
                                                <h3
                                                    class="text-white font-bold text-xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
                                                >
                                                    Akapana Yantalema
                                                </h3>
                                                <p
                                                    class="text-gray-300 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75"
                                                >
                                                Director Ejecutivo <br>
                                                FOUNDER
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                        <!-- Miembro 2 -->
                                        <a href="https://www.linkedin.com/in/ruthbolanos/" target="_blank">
                                        <div
                                            class="relative group aspect-[2.6/3.9] rounded-[30px] overflow-hidden bg-white shadow-lg"
                                        >
                                            <img
                                                :src="Ruth"
                                                alt="Carlos Rodríguez"
                                                class="absolute inset-0 w-full h-full object-contain scale-105 transition-transform duration-500 group-hover:scale-110"
                                            />
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6"
                                            >
                                                <h3
                                                    class="text-white font-bold text-xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
                                                >
                                                RUTH BOLAÑOS NÚÑEZ
                                                </h3>
                                                <p
                                                    class="text-gray-300 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75"
                                                >
                                                Coordinadora Nacional de programas <br>
                                                FOUNDER
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                        <!-- Miembro 3 -->
                                        <a href="https://www.linkedin.com/in/ingridennise/" target="_blank">
                                        <div
                                            class="relative group aspect-[2.6/3.9] rounded-[30px] overflow-hidden bg-white shadow-lg"
                                        >
                                            <img
                                                :src="Ingrid"
                                                alt="Carlos Rodríguez"
                                                class="absolute inset-0 w-full h-full object-contain scale-105 transition-transform duration-500 group-hover:scale-110"
                                            />
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6"
                                            >
                                                <h3
                                                    class="text-white font-bold text-xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
                                                >
                                                INGRID PARDO
                                                </h3>
                                                <p
                                                    class="text-gray-300 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75"
                                                >
                                                Innovación y Economía Naranja
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                        <!-- Miembro 4 -->
                                        <a href="https://www.linkedin.com/in/erika-s%C3%A1nchez-b31398166/" target="_blank">
                                        <div
                                            class="relative group aspect-[2.6/3.9] rounded-[30px] overflow-hidden bg-white shadow-lg"
                                        >
                                            <img
                                                :src="Erika"
                                                alt="Carlos Rodríguez"
                                                class="absolute inset-0 w-full h-full object-contain scale-105 transition-transform duration-500 group-hover:scale-110"
                                            />
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6"
                                            >
                                                <h3
                                                    class="text-white font-bold text-xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
                                                >
                                                ERIKA SÁNCHEZ A.
                                                </h3>
                                                <p
                                                    class="text-gray-300 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75"
                                                >
                                                Cooperación Internacional
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                        <!-- Miembro 5 -->
                                        <a href="https://www.linkedin.com/in/jose-lascano-a7aa181b9/" target="_blank">
                                        <div
                                            class="relative group aspect-[2.6/3.9] rounded-[30px] overflow-hidden bg-white shadow-lg"
                                        >
                                            <img
                                                :src="Jose"
                                                alt="Carlos Rodríguez"
                                                class="absolute inset-0 w-full h-full object-contain scale-110 transition-transform duration-500 group-hover:scale-115"
                                            />
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6"
                                            >
                                                <h3
                                                    class="text-white font-bold text-xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
                                                >
                                                   Jose Lascano
                                                </h3>
                                                <p
                                                    class="text-gray-300 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75"
                                                >
                                                    Relaciones Públicas
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                      
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="interlineado-pequeno">
                                    <p
                                        class="interlineado-pequeno brandonGrotesque-regular txt-azul text-2xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-5xl"
                                    >
                                        PREGUNTA POR
                                    </p>
                                    <p
                                        class="interlineado-pequenopt-10 pb-10 roboto-condensed-semibold txt-anaranjado-fuerte text-xl sm:text-xl md:text-1xl lg:text-2xl xl:text-4xl text-justify"
                                    >
                                        NUESTRO PROGRAMA DE VOLUNTARIADO
                                    </p>
                                </div>

                                <img
                                    class="max-w-[30%] sm:max-w-[30%] md:max-w-[30%] lg:max-w-[20%] xl:max-w-[20%] h-auto transition-transform duration-300 ease-in-out hover:scale-110"
                                    @click="$refs.modal_voluntariado.showModal()" 
                                    :src="boton_curriculo_vitae"
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                    <div class="bg-azul-opaco rounded-b-30">
                        <div
                            class="pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px] pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[90px]"
                        >
                            <div class="interlineado-pequeno">
                                <p
                                    class="brandonGrotesque-regular text-white text-2xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-5xl"
                                >
                                    VALORES
                                </p>
                            </div>
                        </div>
                        <div>
                            <img class="cover h-auto" :src="valores_fondo" />
                        </div>
                        <div
                            class="pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px] pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[90px]"
                        >
                            <div
                                class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 -mt-0 md:-mt-40 lg:-mt-10 xl:-mt-40 relative z-9"
                            >
                                <div class="flex items-center">
                                    <p
                                        class="pt-10 pb-10 roboto-condensed-semibold txt-azul-fuerte text-xl sm:text-xl md:text-1xl lg:text-2xl xl:text-3xl text-justify"
                                    >
                                        Nuestro equipo reúne experiencia en
                                        medios de vida y protección a través de
                                        la innovación, trabajo a nivel nacional
                                        e internacional en desarrollo y
                                        conocimiento de problemas complejos de
                                        desarrollo y sus contextos. Trabajamos
                                        con integridad. Valoramos la diversidad
                                        de antecedentes, experiencias y
                                        pensamientos.
                                    </p>
                                </div>
                                <div class="flotar flex items-center">
                                    <img
                                        class="max-w-[90%] sm:max-w-[80%] md:max-w-[80%] lg:max-w-[70%] xl:max-w-[80%] h-auto mx-auto"
                                        :src="valores_coherencia"
                                    />
                                </div>
                                <div>
                                <div class="interlineado-pequeno">
                                    <p
                                        class="interlineado-pequeno brandonGrotesque-regular txt-azul-fuerte text-2xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-5xl"
                                    >
                                        PREGUNTA POR
                                    </p>
                                    <p
                                        class="interlineado-pequenopt-10 pb-10 roboto-condensed-semibold txt-anaranjado-fuerte text-xl sm:text-xl md:text-1xl lg:text-2xl xl:text-4xl text-justify"
                                    >
                                        NUESTRO PROGRAMA DE VOLUNTARIADO
                                    </p>
                                </div>

                                <img
                                    class="max-w-[30%] sm:max-w-[30%] md:max-w-[30%] lg:max-w-[40%] xl:max-w-[40%] h-auto transition-transform duration-300 ease-in-out hover:scale-110 cursor-pointer"
                                    :src="boton_curriculo_vitae"
                                    @click="$refs.modal_voluntariado.showModal()" 
                                    alt=""
                                />
                                
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Footer></Footer>
    </div>

     <!-- Volunteer Modal -->
     <dialog ref="modal_voluntariado" class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
      <div class="relative">
        <!-- Decorative elements -->
        <div class="absolute -left-16 -top-16 h-48 w-48 rounded-full bg-gradient-to-br from-teal-400 to-blue-500 opacity-20"></div>
        <div class="absolute -bottom-16 -right-16 h-48 w-48 rounded-full bg-gradient-to-br from-blue-400 to-teal-500 opacity-20"></div>
        
        <!-- Close button -->
        <button 
          @click="$refs.modal_voluntariado.close()" 
          class="absolute right-4 top-4 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
        
        <!-- Modal Header -->
        <div class="pt-8 pb-4 px-6">
          <div class="mb-4 flex justify-center">
            <div class="rounded-full bg-gradient-to-r from-teal-500 to-blue-600 p-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
          </div>
          <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">Únete a Nuestro Equipo de Voluntarios</h2>
          <p class="text-center text-gray-600 dark:text-gray-300 mt-2">
            Tu tiempo y habilidades pueden cambiar vidas
          </p>
        </div>
        

        
        <!-- Volunteer information -->
        <div class="p-6 space-y-4">
          <h3 class="font-semibold text-lg text-gray-900 dark:text-white">Cómo ser Voluntario</h3>
          
          <div class="space-y-3">
            <p class="text-gray-600 dark:text-gray-400">
              Estamos buscando personas comprometidas y entusiastas para unirse a nuestro equipo de voluntarios. Si estás interesado en hacer una diferencia, sigue estos pasos:
            </p>
            
            <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-400">
              <li>Prepara tu hoja de vida destacando tus habilidades y experiencias relevantes.</li>
              <li>Escribe una breve carta de motivación explicando por qué quieres ser voluntario.</li>
              <li>Envía ambos documentos a nuestro correo de voluntariado.</li>
            </ol>
          </div>
          
          <div class="mt-6 p-4 bg-teal-50 dark:bg-teal-900/20 rounded-lg border border-teal-100 dark:border-teal-800/30">
            <h4 class="font-semibold text-teal-800 dark:text-teal-300 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              Información de Contacto
            </h4>
            
            <div class="mt-3 space-y-2">
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Correo para voluntarios:</span>
                <span class="font-medium text-gray-900 dark:text-white">info@ninari.org</span>
              </div>
              
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Teléfono:</span>
                <span class="font-medium text-gray-900 dark:text-white">+593 99 669 4952</span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Footer -->
        <div class="p-6 bg-gray-50 dark:bg-gray-800/50">

          <p class="text-center text-xs text-gray-500 dark:text-gray-400 mt-4">
            Tu compromiso puede marcar la diferencia. ¡Esperamos tu postulación!
          </p>
        </div>
      </div>
    </dialog>
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

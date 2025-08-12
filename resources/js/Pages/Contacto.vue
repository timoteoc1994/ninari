<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed,ref, onMounted,watch } from "vue";
import Menu from "@/Components/menu.vue";
import Footer from "@/Components/footer.vue";
import InputError from "@/Components/InputError.vue";
import { usePage } from "@inertiajs/vue3";

const programas_personas = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/programas_personas.png`
);

const foto_contacto = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/contacto/foto_contacto.png`
);
const ninos = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/contacto/ninos.png`
);
const nuve = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/contacto/nuve.png`
);
const locacion = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/contacto/locacion.png`
);
const phone = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/contacto/phone.png`
);
const email = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/contacto/email.png`
);
const valores_fondo = computed(
    () => `${import.meta.env.VITE_APP_URL}/storage/valores_fondo.png`
);

const form = useForm({
    nombre: '',
    email: '',
    mensaje: '',
});

const submit = () => {
    form.post(route('contacto_guardar'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('nombre', 'email', 'mensaje');
            successMessage.value = 'Tu mensaje ha sido enviado correctamente.';
            
            setTimeout(() => {
                successMessage.value = '';
            }, 5000);
        },
    });
};
// Acceder a los mensajes flash correctamente
const page = usePage();
const successMessage = ref('');

// Vigilar cambios en los mensajes flash
watch(() => page.props.flash.success, (newValue) => {
    if (newValue) {
        successMessage.value = newValue;
        
        // Hacer que el mensaje desaparezca después de 5 segundos
        setTimeout(() => {
            successMessage.value = '';
        }, 5000);
    }
});
</script>

<template>
    <Head title="Contacto" />
    <div class="bg-gris relative">
        <!-- Contenido -->
        <div class="pt-6 pb-6">
            <Menu> </Menu>
            <div class="w-11/12 m-auto">
                <div class="">
                    <div class="bg-rosado-raro rounded-t-30">
                        <div>
                            <div
                                class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 items-center"
                            >
                                <div>
                                    <img
                                        class="w-full h-auto mx-auto object-cover"
                                        :src="foto_contacto"
                                    />
                                </div>
                                <div class="pt-10">
                                    <div
                                        class="flex justify-end pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[85px]"
                                    >
                                        <p
                                            className="brandonGrotesque-regular txt-azul text-3xl sm:text-3xl md:text-2xl lg:text-3xl xl:text-5xl animate-fadeInUp"
                                        >
                                            CONTÁCTANOS
                                        </p>
                                        
                                    </div>
                                    <div v-if="successMessage" class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                                            {{ successMessage }}
                                        </div>
                                    <div class="relative">
                                        <img
                                            class="flotar w-full h-auto mx-auto object-cover"
                                            :src="nuve"
                                        />
                                        <form
                                           @submit.prevent="submit"
                                            class="absolute top-10 w-full pl-[40px] sm:pl-[50px] md:pl-[70px] lg:pl-[85px] xl:pl-[85px] pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[85px] animate-fadeInUp"
                                        >
                                            <div class="mt-6">
                                                <input
                                                    type="text"
                                                    class="roboto-condensed-semibold w-full h-12 border-2 border-[#DADADA] bg-[#DADADA] txt-azul placeholder-azul px-4 text-xl focus:outline-none focus:ring-2 focus:ring-[#DADADA] focus:border-[#DADADA] rounded-lg"
                                                    placeholder="NOMBRE"
                                                    v-model="form.nombre"
                                                />
                                                <InputError class="mt-2" :message="form.errors.nombre" />
                                            </div>
                                            <div class="mt-6">
                                                <input
                                                    type="text"
                                                    class="roboto-condensed-semibold w-full h-12 border-2 border-[#DADADA] bg-[#DADADA] txt-azul placeholder-azul px-4 text-xl focus:outline-none focus:ring-2 focus:ring-[#DADADA] focus:border-[#DADADA] rounded-lg"
                                                    placeholder="EMAIL"
                                                     v-model="form.email"
                                                />
                                                <InputError class="mt-2" :message="form.errors.email" />
                                            </div>
                                            <div class="mt-6">
                                                <textarea
                                                    class="roboto-condensed-semibold w-full h-36 border-2 border-[#DADADA] bg-[#DADADA] txt-azul placeholder-azul px-4 text-xl focus:outline-none focus:ring-2 focus:ring-[#DADADA] focus:border-[#DADADA] rounded-lg"
                                                    placeholder="MENSAJE"
                                                     v-model="form.mensaje"
                                                ></textarea>
                                                <InputError class="mt-2" :message="form.errors.mensaje" />
                                            </div>
                                            <div
                                                class="mt-6 pb-10 flex justify-end"
                                            >
                                                <button
                                                    class="bg-anaranjado pt-2 pb-2 pl-6 pr-6 rounded-md text-white text-lg roboto-condensed-semibold shadow-xl"
                                                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                                >
                                                    ENVIAR
                                                </button>
                                            </div>
                                        </form>
                                       
                                    </div>
                                </div>
                            </div>
                            <div
                                class="pt-[40px] pl-[40px] sm:pt-[50px] sm:pl-[50px] md:pt-[70px] md:pl-[70px] lg:pt-[85px] lg:pl-[85px] xl:pt-[90px] xl:pl-[90px] pr-[40px] sm:pr-[50px] md:pr-[70px] lg:pr-[85px] xl:pr-[0px]"
                            >
                                <div
                                    class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-5 items-center pb-10"
                                >
                                    <div>
                                        <div class="flex items-center">
                                            <img
                                                class="max-w-[10%] sm:max-w-[10%] md:max-w-[15%] lg:max-w-[15%] xl:max-w-[10%] h-auto pr-5"
                                                :src="locacion"
                                            />
                                            <p
                                                className="brandonGrotesque-regular text-white text-3xl sm:text-4xl md:text-3xl lg:text-3xl xl:text-3xl"
                                            >
                                                MONTALVO 03-31 Y ROCAFUERTE Y
                                                BOLIVAR
                                            </p>
                                        </div>

                                        <div class="flex items-center pt-5">
                                            <img
                                                class="max-w-[10%] sm:max-w-[10%] md:max-w-[15%] lg:max-w-[15%] xl:max-w-[10%] h-auto pr-5"
                                                :src="email"
                                            />
                                            <p
                                                className="brandonGrotesque-regular text-white text-3xl sm:text-4xl md:text-3xl lg:text-3xl xl:text-3xl"
                                            >
                                                info@ninari.org
                                            </p>
                                        </div>
                                        <div class="flex items-center pt-5">
                                            <img
                                                class="max-w-[10%] sm:max-w-[10%] md:max-w-[15%] lg:max-w-[15%] xl:max-w-[10%] h-auto pr-5"
                                                :src="phone"
                                            />
                                            <p
                                                className="brandonGrotesque-regular text-white text-3xl sm:text-4xl md:text-3xl lg:text-3xl xl:text-3xl"
                                            >
                                                +593 98 427 8057
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="relative w-full h-96 sm:h-[400px] md:h-[500px] lg:h-[600px] xl:h-[600px]"
                                    >
                                        <iframe
                                            class="absolute top-0 left-0 w-full h-full pt-30 xl:pr-[90px]"
                                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d306.76216086472687!2d-78.62962297819932!3d-1.2413545896065548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1ses!2sec!4v1740617930799!5m2!1ses!2sec"
                                            style="border: 0"
                                            allowfullscreen=""
                                            loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"
                                        ></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white">
                        <div
                            class="p-[40px] sm:p-[50px] md:p-[70px] lg:p-[85px] xl:p-[90px]"
                        >
                            <img
                                class="w-full h-auto mx-auto object-cover"
                                :src="ninos"
                            />
                            <div class="">
                                <p
                                    class="text-center pt-10 pb-10 roboto-condensed-semibold txt-azul-fuerte text-xl sm:text-xl md:text-1xl lg:text-2xl xl:text-3xl"
                                >
                                    Desarrollamos programas sistémicos que
                                    inciden en el desarollo económico sostenible
                                    de todas las regiones del Ecuador. <br />
                                    Buscamos trabajar en alianza con Gobiernos
                                    locales, ONG´s, Academia, Sociedad civil y
                                    Sector privado. <br />
                                    Si es de tu interés saber más sobre nuestros
                                    programas contáctate con nosotros
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-b-30">
                        <img class="rounded-b-30 cover h-auto" :src="valores_fondo" />
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

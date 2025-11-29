<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    status: String,
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <Head title="Recuperar contraseña" />

    <div
        class="bg-pattern-doubts min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 px-4"
    >
        <div
            class="w-full sm:max-w-md mt-6 px-8 py-10 glass-card shadow-2xl overflow-hidden sm:rounded-3xl relative z-30 animate-card-enter"
        >
            <div
                class="flex justify-center mb-8 logo-container animate-logo-enter"
            >
                <AuthenticationCardLogo />
            </div>

            <div
                class="mb-6 text-sm text-gray-200 animate-input-enter"
                style="animation-delay: 0.3s"
            >
                ¿Olvidaste tu contraseña? No hay problema. Solo ingresa tu
                correo electrónico y te enviaremos un enlace para restablecer tu
                contraseña.
            </div>

            <div
                v-if="status"
                class="mb-4 font-medium text-sm text-green-400 animate-fade-in"
            >
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div class="animate-input-enter" style="animation-delay: 0.4s">
                    <InputLabel
                        for="email"
                        value="Correo electrónico"
                        class="text-white"
                    />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full bg-white/10 border-white/20 text-white placeholder-gray-300 focus:border-cyan-400 focus:ring-cyan-400"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="tu@ninari.org"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div
                    class="flex items-center justify-between mt-8 animate-input-enter"
                    style="animation-delay: 0.5s"
                >
                    <Link
                        :href="route('login')"
                        class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 focus:ring-offset-transparent"
                    >
                        Volver al inicio de sesión
                    </Link>

                    <button
                        class="btn-forgot"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Enviar enlace
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
.bg-pattern-doubts {
    background: linear-gradient(
        135deg,
        #6610f2 0%,

        #ff6b1c 62.5%,
        #e91e63 75%,
        #9c27b0 87.5%,
        #6610f2 100%
    );
    position: relative;
}

.glass-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

.btn-forgot {
    background: linear-gradient(45deg, #ff681c, #ff0a53);
    border: none;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 104, 28, 0.4);
}

.btn-forgot:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 104, 28, 0.6);
    filter: brightness(1.1);
}

.btn-forgot:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

:deep(input:-webkit-autofill),
:deep(input:-webkit-autofill:hover),
:deep(input:-webkit-autofill:focus),
:deep(input:-webkit-autofill:active) {
    -webkit-box-shadow: 0 0 0 30px #4a1d5c inset !important;
    -webkit-text-fill-color: white !important;
    transition: background-color 5000s ease-in-out 0s;
}

.logo-container :deep(svg) {
    filter: brightness(0) invert(1) drop-shadow(0 2px 5px rgba(0, 0, 0, 0.2));
}

.animate-card-enter {
    animation: cardEntrance 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
    opacity: 0;
    transform: translateY(50px);
}

@keyframes cardEntrance {
    from {
        opacity: 0;
        transform: translateY(50px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.animate-logo-enter {
    animation: logoEntrance 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    opacity: 0;
    transform: scale(0.5);
    animation-delay: 0.2s;
}

@keyframes logoEntrance {
    from {
        opacity: 0;
        transform: scale(0.5);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-input-enter {
    opacity: 0;
    animation: inputSlideIn 0.6s ease-out forwards;
    transform: translateX(-20px);
}

@keyframes inputSlideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-fade-in {
    opacity: 0;
    animation: fadeIn 0.5s ease-out forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>

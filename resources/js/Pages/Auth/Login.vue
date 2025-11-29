<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

const showPassword = ref(false);

const togglePassword = () => {
    showPassword.value = !showPassword.value;
};
</script>

<template>
    <Head title="Log in" />

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
                v-if="status"
                class="mb-4 font-medium text-sm text-green-400 animate-fade-in"
            >
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div class="animate-input-enter" style="animation-delay: 0.4s">
                    <InputLabel for="email" value="Email" class="text-white" />
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
                    class="mt-6 animate-input-enter"
                    style="animation-delay: 0.5s"
                >
                    <InputLabel
                        for="password"
                        value="Contraseña"
                        class="text-white"
                    />
                    <div class="relative">
                        <TextInput
                            id="password"
                            v-model="form.password"
                            :type="showPassword ? 'text' : 'password'"
                            class="mt-1 block w-full bg-white/10 border-white/20 text-white placeholder-gray-300 focus:border-cyan-400 focus:ring-cyan-400 pr-10"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                        />
                        <button
                            type="button"
                            @click="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-300 hover:text-white focus:outline-none"
                            style="top: 50%; transform: translateY(-50%)"
                        >
                            <!-- Eye Icon (Show) -->
                            <svg
                                v-if="!showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                            <!-- Eye Slash Icon (Hide) -->
                            <svg
                                v-else
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"
                                />
                            </svg>
                        </button>
                    </div>
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div
                    class="block mt-6 animate-input-enter"
                    style="animation-delay: 0.6s"
                >
                    <label class="flex items-center">
                        <Checkbox
                            v-model:checked="form.remember"
                            name="remember"
                            class="bg-white/10 border-white/30 text-cyan-500 focus:ring-cyan-400"
                        />
                        <span class="ms-2 text-sm text-gray-200"
                            >Recordarme</span
                        >
                    </label>
                </div>

                <div
                    class="flex items-center justify-end mt-8 animate-input-enter"
                    style="animation-delay: 0.7s"
                >
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 focus:ring-offset-transparent"
                    >
                        ¿Olvidaste tu contraseña?
                    </Link>

                    <button
                        class="ms-4 btn-login"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Iniciar sesión
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

.btn-login {
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

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 104, 28, 0.6);
    filter: brightness(1.1);
}

.btn-login:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* Custom Input Styles override */
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

/* Entrance Animations */
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
    animation-delay: 0.3s;
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
    animation-delay: 0.3s; /* Adjust delay as needed */
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Wrappers para posicionamiento y parallax */
.floating-wrapper {
    position: absolute;
    z-index: 20;
    transition: transform 0.1s ease-out;
    will-change: transform;
    opacity: 0;
    animation: fadeIn 1s ease-out forwards;
}
</style>

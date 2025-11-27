<script setup>
import { ref, onMounted, nextTick } from "vue";
import axios from "axios";

// Estado del chatbot
const isOpen = ref(false);
const isLoading = ref(false);
const userMessage = ref("");
const messages = ref([]);
const chatContainer = ref(null);

// Iconos (reemplaza con tus imágenes si lo deseas)
const logoNinari = "/storage/webninari2/logoblancoarriba.webp";

// Abrir/cerrar chatbot
const toggleChat = () => {
    isOpen.value = !isOpen.value;
    if (isOpen.value && messages.value.length === 0) {
        loadWelcomeMessage();
    }
};

// Cargar mensaje de bienvenida
const loadWelcomeMessage = async () => {
    try {
        const response = await axios.get("/api/chatbot/welcome");
        const data = response.data;

        messages.value.push({
            type: "bot",
            text: data.message,
            subtitle: data.subtitle,
            suggestions: data.suggestions,
            timestamp: new Date(),
        });

        scrollToBottom();
    } catch (error) {
        console.error("Error al cargar mensaje de bienvenida:", error);
    }
};

// Enviar mensaje del usuario
const sendMessage = async () => {
    const trimmedMessage = userMessage.value.trim();
    if (!trimmedMessage || isLoading.value) return;

    // Agregar mensaje del usuario
    messages.value.push({
        type: "user",
        text: trimmedMessage,
        timestamp: new Date(),
    });

    userMessage.value = "";
    isLoading.value = true;
    scrollToBottom();

    try {
        const response = await axios.post("/api/chatbot/chat", {
            message: trimmedMessage,
        });

        // Agregar respuesta del bot
        messages.value.push({
            type: "bot",
            text: response.data.message,
            timestamp: new Date(),
        });

        scrollToBottom();
    } catch (error) {
        console.error("Error al enviar mensaje:", error);
        messages.value.push({
            type: "bot",
            text: "Lo siento, ocurrió un error. Por favor intenta nuevamente.",
            isError: true,
            timestamp: new Date(),
        });
    } finally {
        isLoading.value = false;
    }
};

// Usar sugerencia
const useSuggestion = (suggestion) => {
    userMessage.value = suggestion;
    sendMessage();
};

// Scroll al final del chat
const scrollToBottom = async () => {
    await nextTick();
    if (chatContainer.value) {
        chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
    }
};

// Abrir WhatsApp
const openWhatsApp = () => {
    const phone = "593963211354"; // Reemplaza con el número real
    const message = encodeURIComponent(
        "Hola, me gustaría obtener más información sobre NINARI Foundation."
    );
    window.open(`https://wa.me/${phone}?text=${message}`, "_blank");
};
</script>

<template>
    <div class="chatbot-wrapper">
        <!-- Botón flotante -->
        <transition name="bounce">
            <button
                v-if="!isOpen"
                @click="toggleChat"
                class="chatbot-button"
                aria-label="Abrir chat"
            >
                <img :src="logoNinari" alt="Ninari Bot" class="chatbot-logo" />
                <span class="pulse-ring"></span>
            </button>
        </transition>

        <!-- Ventana del chat -->
        <transition name="slide-up">
            <div v-if="isOpen" class="chatbot-window">
                <!-- Header -->
                <div class="chatbot-header">
                    <div class="header-content">
                        <img
                            :src="logoNinari"
                            alt="Ninari"
                            class="header-logo"
                        />
                        <div class="header-text">
                            <h3>Ninari Bot</h3>
                            <p>Asistente Virtual</p>
                        </div>
                    </div>
                    <button
                        @click="toggleChat"
                        class="close-button"
                        aria-label="Cerrar chat"
                    >
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <!-- Mensajes -->
                <div class="chatbot-messages" ref="chatContainer">
                    <div
                        v-for="(msg, index) in messages"
                        :key="index"
                        :class="['message', msg.type]"
                    >
                        <div class="message-bubble">
                            <p class="message-text">{{ msg.text }}</p>
                            <p v-if="msg.subtitle" class="message-subtitle">
                                {{ msg.subtitle }}
                            </p>

                            <!-- Sugerencias -->
                            <div
                                v-if="msg.suggestions && msg.suggestions.length"
                                class="suggestions"
                            >
                                <button
                                    v-for="(suggestion, idx) in msg.suggestions"
                                    :key="idx"
                                    @click="useSuggestion(suggestion)"
                                    class="suggestion-btn"
                                >
                                    {{ suggestion }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Indicador de escritura -->
                    <div v-if="isLoading" class="message bot">
                        <div class="message-bubble typing">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción rápida -->
                <div class="quick-actions">
                    <button @click="openWhatsApp" class="action-btn whatsapp">
                        <svg
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"
                            />
                        </svg>
                        WhatsApp
                    </button>
                </div>

                <!-- Input de mensaje -->
                <div class="chatbot-input">
                    <input
                        v-model="userMessage"
                        @keyup.enter="sendMessage"
                        type="text"
                        placeholder="Escribe tu pregunta..."
                        :disabled="isLoading"
                        class="message-input"
                    />
                    <button
                        @click="sendMessage"
                        :disabled="!userMessage.trim() || isLoading"
                        class="send-button"
                        aria-label="Enviar mensaje"
                    >
                        <svg
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon
                                points="22 2 15 22 11 13 2 9 22 2"
                            ></polygon>
                        </svg>
                    </button>
                </div>
            </div>
        </transition>
    </div>
</template>

<style scoped>
/* Contenedor principal */
.chatbot-wrapper {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
}

/* Botón flotante */
.chatbot-button {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, #7b1fa2 0%, #551368 100%);
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(85, 19, 104, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all 0.3s ease;
}

.chatbot-button:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(85, 19, 104, 0.6);
}

.chatbot-logo {
    width: 45px;
    height: 45px;
    object-fit: contain;
}

/* Animación de pulso */
.pulse-ring {
    position: absolute;
    width: 100%;
    height: 100%;
    border: 3px solid #7b1fa2;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

/* Ventana del chat */
.chatbot-window {
    width: 380px;
    height: 600px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

/* Header */
.chatbot-header {
    background: linear-gradient(135deg, #7b1fa2 0%, #551368 100%);
    color: white;
    padding: 1.2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-content {
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.header-logo {
    width: 45px;
    height: 45px;
    object-fit: contain;
}

.header-text h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 700;
    font-family: "Barlow-Bold", sans-serif;
}

.header-text p {
    margin: 0;
    font-size: 0.85rem;
    opacity: 0.9;
    font-family: "Barlow-Regular", sans-serif;
}

.close-button {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.close-button:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Mensajes */
.chatbot-messages {
    flex: 1;
    overflow-y: auto;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    background: #f5f5f5;
}

.message {
    display: flex;
    animation: fadeIn 0.3s ease;
}

.message.user {
    justify-content: flex-end;
}

.message.bot {
    justify-content: flex-start;
}

.message-bubble {
    max-width: 75%;
    padding: 0.8rem 1rem;
    border-radius: 15px;
    font-family: "Barlow-Regular", sans-serif;
}

.message.user .message-bubble {
    background: linear-gradient(135deg, #ff681c 0%, #ec720b 100%);
    color: white;
    border-bottom-right-radius: 5px;
}

.message.bot .message-bubble {
    background: white;
    color: #333;
    border-bottom-left-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.message-text {
    margin: 0;
    font-size: 0.95rem;
    line-height: 1.4;
    white-space: pre-wrap;
}

.message-subtitle {
    margin: 0.5rem 0 0 0;
    font-size: 0.85rem;
    opacity: 0.8;
    font-style: italic;
}

/* Sugerencias */
.suggestions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-top: 0.8rem;
}

.suggestion-btn {
    background: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 0.6rem;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: left;
    font-family: "Barlow-Regular", sans-serif;
}

.suggestion-btn:hover {
    background: #ff681c;
    color: white;
    border-color: #ff681c;
}

/* Indicador de escritura */
.typing {
    display: flex;
    gap: 0.3rem;
    padding: 1rem !important;
}

.typing span {
    width: 8px;
    height: 8px;
    background: #999;
    border-radius: 50%;
    animation: typing 1.4s infinite;
}

.typing span:nth-child(2) {
    animation-delay: 0.2s;
}

.typing span:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes typing {
    0%,
    60%,
    100% {
        transform: translateY(0);
    }
    30% {
        transform: translateY(-10px);
    }
}

/* Botones de acción rápida */
.quick-actions {
    padding: 0.8rem 1rem;
    background: white;
    border-top: 1px solid #eee;
}

.action-btn {
    width: 100%;
    padding: 0.7rem;
    border: none;
    border-radius: 10px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    font-family: "Barlow-SemiBold", sans-serif;
}

.action-btn.whatsapp {
    background: #25d366;
    color: white;
}

.action-btn.whatsapp:hover {
    background: #20ba5a;
    transform: translateY(-2px);
}

/* Input de mensaje */
.chatbot-input {
    padding: 1rem;
    background: white;
    border-top: 1px solid #eee;
    display: flex;
    gap: 0.5rem;
}

.message-input {
    flex: 1;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 25px;
    font-size: 0.95rem;
    outline: none;
    font-family: "Barlow-Regular", sans-serif;
}

.message-input:focus {
    border-color: #7b1fa2;
}

.send-button {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ff681c 0%, #ec720b 100%);
    border: none;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.send-button:hover:not(:disabled) {
    transform: scale(1.1);
}

.send-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Animaciones */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.bounce-enter-active {
    animation: bounce 0.5s;
}

@keyframes bounce {
    0%,
    100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

.slide-up-enter-active,
.slide-up-leave-active {
    transition: all 0.3s ease;
}

.slide-up-enter-from {
    opacity: 0;
    transform: translateY(20px);
}

.slide-up-leave-to {
    opacity: 0;
    transform: translateY(20px);
}

/* Responsive */
@media (max-width: 768px) {
    .chatbot-window {
        width: calc(100vw - 20px);
        height: calc(100vh - 100px);
        position: fixed;
        bottom: 10px;
        right: 10px;
    }

    .chatbot-button {
        width: 60px;
        height: 60px;
    }

    .chatbot-logo {
        width: 35px;
        height: 35px;
    }
}

/* Scrollbar personalizado */
.chatbot-messages::-webkit-scrollbar {
    width: 6px;
}

.chatbot-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.chatbot-messages::-webkit-scrollbar-thumb {
    background: #7b1fa2;
    border-radius: 3px;
}

.chatbot-messages::-webkit-scrollbar-thumb:hover {
    background: #551368;
}
</style>

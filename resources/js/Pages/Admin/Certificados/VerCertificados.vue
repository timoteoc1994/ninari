<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DialogModal from "@/Components/DialogModal.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import FileInput from "@/Components/FileInput.vue";
import VisualEditor from "./Components/VisualEditor.vue";
import SendWizard from "./Components/SendWizard.vue";
import HistoryView from "./Components/HistoryView.vue";
import Modal from "@/Components/Modal.vue"; // Using generic modal for custom content
import { ref, computed, watch } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import axios from "axios";

const props = defineProps({
    certificados: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
    auth: Object,
});

// Search functionality
const search = ref(props.filters.search || "");
let searchTimeout = null;

watch(search, (value) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(
            route("certificados.index"),
            { search: value },
            {
                preserveState: true,
                preserveScroll: true,
            }
        );
    }, 300);
});

// Available colors for certificates
const availableColors = [
    { name: "Oro", value: "bg-yellow-500", preview: "#eab308" },
    { name: "Índigo", value: "bg-indigo-500", preview: "#6366f1" },
    { name: "Púrpura", value: "bg-purple-500", preview: "#a855f7" },
    { name: "Rojo", value: "bg-red-500", preview: "#ef4444" },
    { name: "Rosa", value: "bg-pink-500", preview: "#ec4899" },
    { name: "Azul", value: "bg-blue-500", preview: "#3b82f6" },
    { name: "Verde", value: "bg-green-500", preview: "#22c55e" },
    { name: "Turquesa", value: "bg-teal-500", preview: "#14b8a6" },
    { name: "Naranja", value: "bg-orange-500", preview: "#f97316" },
    { name: "Cian", value: "bg-cyan-500", preview: "#06b6d4" },
    { name: "Esmeralda", value: "bg-emerald-500", preview: "#10b981" },
    { name: "Fucsia", value: "bg-fuchsia-500", preview: "#d946ef" },
];

// Modal states
const showCreateModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);
const showVariablesModal = ref(false);
const showSendModal = ref(false);
const showHistoryModal = ref(false);
const selectedCertificate = ref(null);

// Variables state
const currentVariables = ref([]);

const loadVariables = async (certificateId) => {
    try {
        const response = await axios.get(
            route("certificados.variables.index", certificateId)
        );
        currentVariables.value = response.data;
    } catch (error) {
        console.error("Error loading variables", error);
        currentVariables.value = [];
    }
};

const saveVariables = async (variables) => {
    try {
        await axios.post(
            route("certificados.variables.store", selectedCertificate.value.id),
            {
                variables: variables,
            }
        );
        showVariablesModal.value = false;
        // Optional: Show success notification
    } catch (error) {
        console.error("Error saving variables", error);
    }
};

// Forms
const createForm = useForm({
    nombre: "",
    badge: "",
    color: "bg-indigo-500",
    pdf_file: null,
});

const editForm = useForm({
    nombre: "",
    badge: "",
    color: "",
    pdf_file: null,
});

const deleteForm = useForm({
    nombre_confirmacion: "",
});

// Open modals
const openCreateModal = () => {
    createForm.reset();
    createForm.clearErrors();
    showCreateModal.value = true;
};

const openEditModal = (certificate) => {
    selectedCertificate.value = certificate;
    editForm.nombre = certificate.nombre;
    editForm.badge = certificate.badge;
    editForm.color = certificate.color;
    editForm.pdf_file = null;
    editForm.clearErrors();
    showEditModal.value = true;
};

const openDeleteModal = (certificate) => {
    selectedCertificate.value = certificate;
    deleteForm.reset();
    deleteForm.clearErrors();
    showDeleteModal.value = true;
};

const openVariablesModal = async (certificate) => {
    selectedCertificate.value = certificate;
    await loadVariables(certificate.id);
    showVariablesModal.value = true;
};

const openSendModal = async (certificate) => {
    selectedCertificate.value = certificate;
    await loadVariables(certificate.id);
    showSendModal.value = true;
};

const openHistoryModal = (certificate) => {
    selectedCertificate.value = certificate;
    showHistoryModal.value = true;
};

// Close modals
const closeCreateModal = () => {
    showCreateModal.value = false;
    createForm.reset();
};

const closeEditModal = () => {
    showEditModal.value = false;
    editForm.reset();
    selectedCertificate.value = null;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    deleteForm.reset();
    selectedCertificate.value = null;
};

// Submit handlers
const submitCreate = () => {
    createForm.post(route("certificados.store"), {
        preserveScroll: true,
        onSuccess: () => {
            closeCreateModal();
        },
    });
};

const submitEdit = () => {
    editForm.post(route("certificados.update", selectedCertificate.value.id), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            closeEditModal();
        },
    });
};

const submitDelete = () => {
    deleteForm.delete(
        route("certificados.destroy", selectedCertificate.value.id),
        {
            preserveScroll: true,
            onSuccess: () => {
                closeDeleteModal();
            },
        }
    );
};

// Check if user can delete certificate
const canDelete = (certificate) => {
    return props.auth?.user?.id === certificate.user_id;
};
</script>

<template>
    <AppLayout title="Certificados">
        <template #header>
            <div class="flex justify-between items-center">
                <h2
                    class="font-bold text-2xl text-gray-800 dark:text-white leading-tight"
                >
                    Certificados
                </h2>
                <span class="text-sm text-gray-500 dark:text-gray-400"
                    >{{ certificados.total }} Documentos</span
                >
            </div>
        </template>

        <div class="py-12 min-h-screen bg-gray-50 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Search Bar -->
                <div class="mb-8 px-4 sm:px-0">
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                        >
                            <svg
                                class="h-5 w-5 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </div>
                        <input
                            v-model="search"
                            type="text"
                            placeholder="Buscar certificados por nombre..."
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-200"
                        />
                    </div>
                </div>

                <!-- Empty State -->
                <div
                    v-if="!certificados.data || certificados.data.length === 0"
                    class="text-center py-12"
                >
                    <svg
                        class="mx-auto h-24 w-24 text-gray-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        />
                    </svg>
                    <h3
                        class="mt-4 text-lg font-medium text-gray-900 dark:text-white"
                    >
                        No hay certificados
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Comienza creando tu primer certificado
                    </p>
                </div>

                <!-- Grid Container -->
                <div
                    v-else
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-4 sm:px-0"
                >
                    <!-- Certificate Cards -->
                    <div
                        v-for="(cert, index) in certificados.data"
                        :key="cert.id"
                        class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 overflow-hidden border border-gray-100 dark:border-gray-700"
                        :style="{ animationDelay: `${index * 100}ms` }"
                    >
                        <!-- PDF Preview Section -->
                        <div
                            class="relative h-56 bg-gray-200 dark:bg-gray-700 overflow-hidden cursor-pointer"
                            @click="openEditModal(cert)"
                        >
                            <iframe
                                :src="
                                    cert.pdf_url +
                                    '#toolbar=0&navpanes=0&scrollbar=0'
                                "
                                class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none scale-105 group-hover:scale-110"
                                style="border: none"
                            ></iframe>

                            <!-- Overlay Gradient -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-300"
                            ></div>

                            <!-- Badge -->
                            <div class="absolute top-3 right-3">
                                <span
                                    :class="`${cert.color} text-white text-xs font-bold px-3 py-1 rounded-full shadow-md backdrop-blur-sm bg-opacity-90`"
                                >
                                    {{ cert.badge }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-5 relative">
                            <h3
                                class="text-lg font-bold text-gray-800 dark:text-white mb-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors"
                            >
                                {{ cert.nombre }}
                            </h3>
                            <div class="flex items-center mt-2">
                                <div
                                    class="w-6 h-6 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-xs font-bold text-gray-600 dark:text-gray-300 mr-2"
                                >
                                    {{ cert.creator.charAt(0) }}
                                </div>
                                <p
                                    class="text-sm text-gray-500 dark:text-gray-400 font-medium"
                                >
                                    {{ cert.creator }}
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2 mt-4">
                                <button
                                    @click="openEditModal(cert)"
                                    class="flex-1 bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-bold py-2 px-3 rounded-lg transition-colors duration-200"
                                >
                                    Editar
                                </button>
                                <button
                                    v-if="canDelete(cert)"
                                    @click="openDeleteModal(cert)"
                                    class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-2 px-3 rounded-lg transition-colors duration-200"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        />
                                    </svg>
                                </button>
                            </div>

                            <!-- Secondary Actions -->
                            <div class="flex gap-2 mt-2">
                                <button
                                    @click="openVariablesModal(cert)"
                                    class="flex-1 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-bold py-2 px-3 rounded-lg transition-colors duration-200"
                                    title="Configurar Variables"
                                >
                                    Variables
                                </button>
                                <button
                                    @click="openSendModal(cert)"
                                    class="flex-1 bg-green-500 hover:bg-green-600 text-white text-xs font-bold py-2 px-3 rounded-lg transition-colors duration-200"
                                    title="Enviar Certificado"
                                >
                                    Enviar
                                </button>
                                <button
                                    @click="openHistoryModal(cert)"
                                    class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-2 px-3 rounded-lg transition-colors duration-200"
                                    title="Historial"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div
                    v-if="certificados.data && certificados.data.length > 0"
                    class="mt-8 px-4 sm:px-0"
                >
                    <div
                        class="flex items-center justify-between border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-3 sm:px-6 rounded-lg shadow"
                    >
                        <div class="flex flex-1 justify-between sm:hidden">
                            <a
                                v-if="certificados.prev_page_url"
                                :href="certificados.prev_page_url"
                                class="relative inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                Anterior
                            </a>
                            <a
                                v-if="certificados.next_page_url"
                                :href="certificados.next_page_url"
                                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                Siguiente
                            </a>
                        </div>
                        <div
                            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
                        >
                            <div>
                                <p
                                    class="text-sm text-gray-700 dark:text-gray-300"
                                >
                                    Mostrando
                                    <span class="font-medium">{{
                                        certificados.from
                                    }}</span>
                                    a
                                    <span class="font-medium">{{
                                        certificados.to
                                    }}</span>
                                    de
                                    <span class="font-medium">{{
                                        certificados.total
                                    }}</span>
                                    resultados
                                </p>
                            </div>
                            <div>
                                <nav
                                    class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                                    aria-label="Pagination"
                                >
                                    <!-- Previous Button -->
                                    <a
                                        v-if="certificados.prev_page_url"
                                        :href="certificados.prev_page_url"
                                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0"
                                    >
                                        <span class="sr-only">Anterior</span>
                                        <svg
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </a>
                                    <span
                                        v-else
                                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-300 dark:text-gray-600 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 cursor-not-allowed"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </span>

                                    <!-- Page Numbers -->
                                    <template
                                        v-for="(
                                            link, index
                                        ) in certificados.links"
                                        :key="index"
                                    >
                                        <a
                                            v-if="
                                                link.url &&
                                                !link.label.includes(
                                                    'Previous'
                                                ) &&
                                                !link.label.includes('Next')
                                            "
                                            :href="link.url"
                                            :class="[
                                                link.active
                                                    ? 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                                                    : 'text-gray-900 dark:text-gray-300 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-offset-0',
                                                'relative inline-flex items-center px-4 py-2 text-sm font-semibold focus:z-20',
                                            ]"
                                            v-html="link.label"
                                        >
                                        </a>
                                        <span
                                            v-else-if="
                                                !link.url &&
                                                !link.label.includes(
                                                    'Previous'
                                                ) &&
                                                !link.label.includes('Next')
                                            "
                                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-400 ring-1 ring-inset ring-gray-300 dark:ring-gray-600"
                                        >
                                            ...
                                        </span>
                                    </template>

                                    <!-- Next Button -->
                                    <a
                                        v-if="certificados.next_page_url"
                                        :href="certificados.next_page_url"
                                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0"
                                    >
                                        <span class="sr-only">Siguiente</span>
                                        <svg
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </a>
                                    <span
                                        v-else
                                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-300 dark:text-gray-600 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 cursor-not-allowed"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Action Button (FAB) -->
            <button
                @click="openCreateModal"
                class="fixed bottom-10 right-10 bg-indigo-600 hover:bg-indigo-500 text-white p-4 rounded-full shadow-2xl hover:shadow-indigo-500/50 transform hover:scale-110 active:scale-95 transition-all duration-300 z-50 group flex items-center justify-center"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 group-hover:rotate-90 transition-transform duration-300"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"
                    />
                </svg>
                <span
                    class="absolute right-full mr-4 bg-gray-900 text-white text-xs font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap"
                >
                    Nuevo Certificado
                </span>
            </button>
        </div>

        <!-- Create Modal -->
        <DialogModal
            :show="showCreateModal"
            @close="closeCreateModal"
            max-width="2xl"
        >
            <template #title>
                <div class="flex items-center">
                    <svg
                        class="h-6 w-6 text-indigo-500 mr-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>
                    Crear Nuevo Certificado
                </div>
            </template>

            <template #content>
                <form @submit.prevent="submitCreate" class="space-y-6">
                    <!-- Nombre -->
                    <div>
                        <InputLabel
                            for="create_nombre"
                            value="Nombre del Certificado"
                        />
                        <TextInput
                            id="create_nombre"
                            v-model="createForm.nombre"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="Ej: Certificado de Excelencia"
                        />
                        <InputError
                            :message="createForm.errors.nombre"
                            class="mt-2"
                        />
                    </div>

                    <!-- Badge -->
                    <div>
                        <InputLabel for="create_badge" value="Etiqueta" />
                        <TextInput
                            id="create_badge"
                            v-model="createForm.badge"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="Ej: Oro, Pro, Premium"
                        />
                        <InputError
                            :message="createForm.errors.badge"
                            class="mt-2"
                        />
                    </div>

                    <!-- Color Picker -->
                    <div>
                        <InputLabel value="Color de la Etiqueta" />
                        <div class="mt-3 grid grid-cols-4 sm:grid-cols-6 gap-3">
                            <button
                                v-for="color in availableColors"
                                :key="color.value"
                                type="button"
                                @click="createForm.color = color.value"
                                class="group relative flex flex-col items-center justify-center p-3 rounded-lg border-2 transition-all duration-200 hover:scale-105"
                                :class="
                                    createForm.color === color.value
                                        ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20'
                                        : 'border-gray-200 dark:border-gray-700 hover:border-gray-300'
                                "
                            >
                                <div
                                    class="w-8 h-8 rounded-full shadow-md"
                                    :style="{ backgroundColor: color.preview }"
                                ></div>
                                <span
                                    class="mt-1 text-xs font-medium text-gray-700 dark:text-gray-300"
                                    >{{ color.name }}</span
                                >
                                <svg
                                    v-if="createForm.color === color.value"
                                    class="absolute top-1 right-1 h-4 w-4 text-indigo-500"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </div>
                        <InputError
                            :message="createForm.errors.color"
                            class="mt-2"
                        />
                    </div>

                    <!-- PDF Upload -->
                    <div>
                        <InputLabel value="Archivo PDF" />
                        <div class="mt-2">
                            <FileInput
                                v-model="createForm.pdf_file"
                                :error="createForm.errors.pdf_file"
                            />
                        </div>
                    </div>
                </form>
            </template>

            <template #footer>
                <SecondaryButton
                    @click="closeCreateModal"
                    :disabled="createForm.processing"
                >
                    Cancelar
                </SecondaryButton>

                <PrimaryButton
                    class="ml-3"
                    @click="submitCreate"
                    :class="{ 'opacity-25': createForm.processing }"
                    :disabled="createForm.processing"
                >
                    <span v-if="createForm.processing">Creando...</span>
                    <span v-else>Crear Certificado</span>
                </PrimaryButton>
            </template>
        </DialogModal>

        <!-- Edit Modal -->
        <DialogModal
            :show="showEditModal"
            @close="closeEditModal"
            max-width="2xl"
        >
            <template #title>
                <div class="flex items-center">
                    <svg
                        class="h-6 w-6 text-indigo-500 mr-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                        />
                    </svg>
                    Editar Certificado
                </div>
            </template>

            <template #content>
                <form @submit.prevent="submitEdit" class="space-y-6">
                    <!-- Nombre -->
                    <div>
                        <InputLabel
                            for="edit_nombre"
                            value="Nombre del Certificado"
                        />
                        <TextInput
                            id="edit_nombre"
                            v-model="editForm.nombre"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <InputError
                            :message="editForm.errors.nombre"
                            class="mt-2"
                        />
                    </div>

                    <!-- Badge -->
                    <div>
                        <InputLabel for="edit_badge" value="Etiqueta" />
                        <TextInput
                            id="edit_badge"
                            v-model="editForm.badge"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <InputError
                            :message="editForm.errors.badge"
                            class="mt-2"
                        />
                    </div>

                    <!-- Color Picker -->
                    <div>
                        <InputLabel value="Color de la Etiqueta" />
                        <div class="mt-3 grid grid-cols-4 sm:grid-cols-6 gap-3">
                            <button
                                v-for="color in availableColors"
                                :key="color.value"
                                type="button"
                                @click="editForm.color = color.value"
                                class="group relative flex flex-col items-center justify-center p-3 rounded-lg border-2 transition-all duration-200 hover:scale-105"
                                :class="
                                    editForm.color === color.value
                                        ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20'
                                        : 'border-gray-200 dark:border-gray-700 hover:border-gray-300'
                                "
                            >
                                <div
                                    class="w-8 h-8 rounded-full shadow-md"
                                    :style="{ backgroundColor: color.preview }"
                                ></div>
                                <span
                                    class="mt-1 text-xs font-medium text-gray-700 dark:text-gray-300"
                                    >{{ color.name }}</span
                                >
                                <svg
                                    v-if="editForm.color === color.value"
                                    class="absolute top-1 right-1 h-4 w-4 text-indigo-500"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </div>
                        <InputError
                            :message="editForm.errors.color"
                            class="mt-2"
                        />
                    </div>

                    <!-- PDF Upload (Optional) -->
                    <div>
                        <InputLabel value="Reemplazar PDF (Opcional)" />
                        <div class="mt-2">
                            <FileInput
                                v-model="editForm.pdf_file"
                                :error="editForm.errors.pdf_file"
                            />
                        </div>
                        <p
                            class="mt-1 text-xs text-gray-500 dark:text-gray-400"
                        >
                            Deja vacío para mantener el PDF actual
                        </p>
                    </div>
                </form>
            </template>

            <template #footer>
                <SecondaryButton
                    @click="closeEditModal"
                    :disabled="editForm.processing"
                >
                    Cancelar
                </SecondaryButton>

                <PrimaryButton
                    class="ml-3"
                    @click="submitEdit"
                    :class="{ 'opacity-25': editForm.processing }"
                    :disabled="editForm.processing"
                >
                    <span v-if="editForm.processing">Guardando...</span>
                    <span v-else>Guardar Cambios</span>
                </PrimaryButton>
            </template>
        </DialogModal>

        <!-- Delete Modal -->
        <ConfirmationModal :show="showDeleteModal" @close="closeDeleteModal">
            <template #title> Eliminar Certificado </template>

            <template #content>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    ¿Estás seguro de que deseas eliminar este certificado? Esta
                    acción no se puede deshacer.
                </p>

                <div
                    class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4"
                >
                    <p
                        class="text-sm font-medium text-yellow-800 dark:text-yellow-200 mb-2"
                    >
                        Para confirmar, escribe el nombre del certificado:
                    </p>
                    <p
                        class="text-sm font-bold text-yellow-900 dark:text-yellow-100 mb-3"
                    >
                        "{{ selectedCertificate?.nombre }}"
                    </p>
                    <TextInput
                        v-model="deleteForm.nombre_confirmacion"
                        type="text"
                        class="w-full"
                        placeholder="Escribe el nombre del certificado"
                    />
                    <InputError
                        :message="deleteForm.errors.nombre_confirmacion"
                        class="mt-2"
                    />
                </div>
            </template>

            <template #footer>
                <SecondaryButton
                    @click="closeDeleteModal"
                    :disabled="deleteForm.processing"
                >
                    Cancelar
                </SecondaryButton>

                <DangerButton
                    class="ml-3"
                    @click="submitDelete"
                    :class="{ 'opacity-25': deleteForm.processing }"
                    :disabled="deleteForm.processing"
                >
                    <span v-if="deleteForm.processing">Eliminando...</span>
                    <span v-else>Eliminar Certificado</span>
                </DangerButton>
            </template>
        </ConfirmationModal>
        <!-- Variables Modal (Full Screen) -->
        <Modal
            :show="showVariablesModal"
            @close="showVariablesModal = false"
            maxWidth="full"
        >
            <div class="h-screen flex flex-col bg-white dark:bg-gray-900">
                <div
                    class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700"
                >
                    <h2
                        class="text-lg font-medium text-gray-900 dark:text-white"
                    >
                        Editor de Variables: {{ selectedCertificate?.nombre }}
                    </h2>
                    <button
                        @click="showVariablesModal = false"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                    >
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 overflow-hidden">
                    <VisualEditor
                        v-if="selectedCertificate"
                        :pdf-url="selectedCertificate.pdf_url"
                        :initial-variables="selectedCertificate.variables || []"
                        @save="saveVariables"
                    />
                </div>
            </div>
        </Modal>

        <!-- Send Modal -->
        <DialogModal
            :show="showSendModal"
            @close="showSendModal = false"
            maxWidth="2xl"
        >
            <template #title> Enviar Certificado </template>
            <template #content>
                <SendWizard
                    v-if="selectedCertificate"
                    :certificado="selectedCertificate"
                    :variables="currentVariables"
                    @close="showSendModal = false"
                />
            </template>
            <template #footer>
                <!-- Footer handled inside SendWizard -->
            </template>
        </DialogModal>

        <!-- History Modal -->
        <DialogModal
            :show="showHistoryModal"
            @close="showHistoryModal = false"
            maxWidth="2xl"
        >
            <template #title>
                Historial de Envíos: {{ selectedCertificate?.nombre }}
            </template>
            <template #content>
                <HistoryView
                    v-if="selectedCertificate"
                    :certificate-id="selectedCertificate.id"
                />
            </template>
            <template #footer>
                <SecondaryButton @click="showHistoryModal = false">
                    Cerrar
                </SecondaryButton>
            </template>
        </DialogModal>
    </AppLayout>
</template>

<style scoped>
/* Animations for certificate cards */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

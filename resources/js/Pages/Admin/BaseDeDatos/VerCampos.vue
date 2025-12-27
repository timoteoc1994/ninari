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
import { ref, watch } from "vue";
import { useForm, router, Link } from "@inertiajs/vue3";

const props = defineProps({
    fields: Object,
    filters: {
        type: Object,
        default: () => ({}),
    },
});

// Search
const search = ref(props.filters.search || "");
let searchTimeout = null;

watch(search, (value) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(
            route("entity-fields.index"),
            { search: value },
            {
                preserveState: true,
                preserveScroll: true,
            }
        );
    }, 300);
});

// Modal states
const showCreateModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);
const selectedField = ref(null);

// Data types
const dataTypes = [
    { value: "text", label: "Texto", icon: "📝", description: "Texto libre" },
    {
        value: "number",
        label: "Número",
        icon: "🔢",
        description: "Valores numéricos",
    },
    {
        value: "boolean",
        label: "Sí/No",
        icon: "✅",
        description: "Verdadero o falso",
    },
    { value: "date", label: "Fecha", icon: "📅", description: "Fecha" },
    {
        value: "select",
        label: "Lista",
        icon: "📋",
        description: "Selección múltiple",
    },
];

// Forms
const createForm = useForm({
    nombre_campo: "",
    etiqueta: "",
    tipo_dato: "text",
    opciones: [],
    es_requerido: false,
    orden: 0,
});

const editForm = useForm({
    nombre_campo: "",
    etiqueta: "",
    tipo_dato: "",
    opciones: [],
    es_requerido: false,
    orden: 0,
});

const deleteForm = useForm({
    nombre_confirmacion: "",
});

// Options for select field
const newOption = ref("");

const addOption = (form) => {
    if (newOption.value && !form.opciones.includes(newOption.value)) {
        form.opciones.push(newOption.value);
        newOption.value = "";
    }
};

const removeOption = (form, index) => {
    form.opciones.splice(index, 1);
};

// Open modals
const openCreateModal = () => {
    createForm.reset();
    createForm.clearErrors();
    createForm.opciones = [];
    showCreateModal.value = true;
};

const openEditModal = (field) => {
    selectedField.value = field;
    editForm.nombre_campo = field.nombre_campo;
    editForm.etiqueta = field.etiqueta;
    editForm.tipo_dato = field.tipo_dato;
    editForm.opciones = field.opciones ? [...field.opciones] : [];
    editForm.es_requerido = field.es_requerido;
    editForm.orden = field.orden;
    editForm.clearErrors();
    showEditModal.value = true;
};

const openDeleteModal = (field) => {
    selectedField.value = field;
    deleteForm.reset();
    deleteForm.clearErrors();
    showDeleteModal.value = true;
};

// Close modals
const closeCreateModal = () => {
    showCreateModal.value = false;
    createForm.reset();
};

const closeEditModal = () => {
    showEditModal.value = false;
    editForm.reset();
    selectedField.value = null;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    deleteForm.reset();
    selectedField.value = null;
};

// Submit handlers
const submitCreate = () => {
    createForm.post(route("entity-fields.store"), {
        preserveScroll: true,
        onSuccess: () => {
            closeCreateModal();
        },
    });
};

const submitEdit = () => {
    editForm.put(route("entity-fields.update", selectedField.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            closeEditModal();
        },
    });
};

const submitDelete = () => {
    deleteForm.delete(
        route("entity-fields.destroy", selectedField.value.id),
        {
            preserveScroll: true,
            onSuccess: () => {
                closeDeleteModal();
            },
        }
    );
};

// Get data type config
const getDataTypeConfig = (type) => {
    return dataTypes.find((t) => t.value === type) || dataTypes[0];
};

// Generate nombre_campo from etiqueta
watch(
    () => createForm.etiqueta,
    (value) => {
        if (value && !createForm.nombre_campo) {
            createForm.nombre_campo = value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, "_")
                .replace(/^_|_$/g, "");
        }
    }
);
</script>

<template>
    <AppLayout title="Gestión de Campos">
        <template #header>
            <div class="flex justify-between items-center">
                <h2
                    class="font-bold text-2xl text-gray-800 dark:text-white leading-tight"
                >
                    Gestión de Campos Dinámicos
                </h2>
                <div class="flex items-center gap-4">
                    <Link
                        :href="route('entities.index')"
                        class="text-sm text-gray-600 hover:text-gray-700 dark:text-gray-400 font-medium"
                    >
                        ← Volver a Base de Datos
                    </Link>
                    <span class="text-sm text-gray-500 dark:text-gray-400"
                        >{{ fields.total }} Campos</span
                    >
                </div>
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
                            placeholder="Buscar campos..."
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-200"
                        />
                    </div>
                </div>

                <!-- Empty State -->
                <div
                    v-if="!fields.data || fields.data.length === 0"
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
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                        />
                    </svg>
                    <h3
                        class="mt-4 text-lg font-medium text-gray-900 dark:text-white"
                    >
                        No hay campos configurados
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Comienza creando tu primer campo dinámico
                    </p>
                </div>

                <!-- Fields Grid -->
                <div
                    v-else
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-4 sm:px-0"
                >
                    <div
                        v-for="field in fields.data"
                        :key="field.id"
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-200 dark:border-gray-700"
                    >
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center">
                                    <span class="text-3xl mr-3">{{
                                        getDataTypeConfig(field.tipo_dato).icon
                                    }}</span>
                                    <div>
                                        <h3
                                            class="text-lg font-bold text-gray-900 dark:text-white"
                                        >
                                            {{ field.etiqueta }}
                                        </h3>
                                        <p
                                            class="text-xs text-gray-500 dark:text-gray-400 font-mono"
                                        >
                                            {{ field.nombre_campo }}
                                        </p>
                                    </div>
                                </div>
                                <span
                                    v-if="field.es_requerido"
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400"
                                >
                                    Requerido
                                </span>
                            </div>

                            <div class="mt-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/20 dark:text-indigo-400"
                                >
                                    {{
                                        getDataTypeConfig(field.tipo_dato).label
                                    }}
                                </span>
                            </div>

                            <!-- Options for select type -->
                            <div
                                v-if="
                                    field.tipo_dato === 'select' &&
                                    field.opciones &&
                                    field.opciones.length > 0
                                "
                                class="mt-3"
                            >
                                <p
                                    class="text-xs text-gray-500 dark:text-gray-400 mb-2"
                                >
                                    Opciones:
                                </p>
                                <div class="flex flex-wrap gap-1">
                                    <span
                                        v-for="(option, index) in field.opciones.slice(
                                            0,
                                            3
                                        )"
                                        :key="index"
                                        class="inline-flex items-center px-2 py-1 rounded text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300"
                                    >
                                        {{ option }}
                                    </span>
                                    <span
                                        v-if="field.opciones.length > 3"
                                        class="text-xs text-gray-500 dark:text-gray-400"
                                    >
                                        +{{ field.opciones.length - 3 }} más
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 flex gap-2">
                                <button
                                    @click="openEditModal(field)"
                                    class="flex-1 bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-bold py-2 px-3 rounded-lg transition-colors duration-200"
                                >
                                    Editar
                                </button>
                                <button
                                    @click="openDeleteModal(field)"
                                    class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-2 px-3 rounded-lg transition-colors duration-200"
                                >
                                    🗑️
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div
                    v-if="fields.data && fields.data.length > 0"
                    class="mt-8 px-4 sm:px-0"
                >
                    <div
                        class="flex items-center justify-between border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-3 sm:px-6 rounded-lg shadow"
                    >
                        <div class="flex flex-1 justify-between sm:hidden">
                            <a
                                v-if="fields.prev_page_url"
                                :href="fields.prev_page_url"
                                class="relative inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                Anterior
                            </a>
                            <a
                                v-if="fields.next_page_url"
                                :href="fields.next_page_url"
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
                                        fields.from
                                    }}</span>
                                    a
                                    <span class="font-medium">{{
                                        fields.to
                                    }}</span>
                                    de
                                    <span class="font-medium">{{
                                        fields.total
                                    }}</span>
                                    resultados
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Action Button -->
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
                    Nuevo Campo
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
                    Crear Nuevo Campo
                </div>
            </template>

            <template #content>
                <form @submit.prevent="submitCreate" class="space-y-6">
                    <!-- Etiqueta -->
                    <div>
                        <InputLabel for="create_etiqueta" value="Etiqueta (visible para usuarios) *" />
                        <TextInput
                            id="create_etiqueta"
                            v-model="createForm.etiqueta"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="Ej: Correo Electrónico"
                            required
                        />
                        <InputError
                            :message="createForm.errors.etiqueta"
                            class="mt-2"
                        />
                    </div>

                    <!-- Nombre Campo -->
                    <div>
                        <InputLabel for="create_nombre_campo" value="Nombre técnico (único, sin espacios) *" />
                        <TextInput
                            id="create_nombre_campo"
                            v-model="createForm.nombre_campo"
                            type="text"
                            class="mt-1 block w-full font-mono"
                            placeholder="correo_electronico"
                            required
                        />
                        <InputError
                            :message="createForm.errors.nombre_campo"
                            class="mt-2"
                        />
                    </div>

                    <!-- Tipo de Dato -->
                    <div>
                        <InputLabel value="Tipo de Dato *" />
                        <div class="mt-3 grid grid-cols-2 md:grid-cols-3 gap-3">
                            <button
                                v-for="type in dataTypes"
                                :key="type.value"
                                type="button"
                                @click="createForm.tipo_dato = type.value"
                                :class="[
                                    createForm.tipo_dato === type.value
                                        ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20'
                                        : 'border-gray-200 dark:border-gray-700 hover:border-gray-300',
                                    'relative flex flex-col items-center justify-center p-4 rounded-lg border-2 transition-all duration-200 hover:scale-105',
                                ]"
                            >
                                <span class="text-2xl mb-1">{{
                                    type.icon
                                }}</span>
                                <span
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300"
                                    >{{ type.label }}</span
                                >
                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ type.description }}</span>
                            </button>
                        </div>
                        <InputError
                            :message="createForm.errors.tipo_dato"
                            class="mt-2"
                        />
                    </div>

                    <!-- Opciones (solo para select) -->
                    <div v-if="createForm.tipo_dato === 'select'">
                        <InputLabel value="Opciones de la Lista" />
                        <div class="mt-2 flex gap-2">
                            <TextInput
                                v-model="newOption"
                                type="text"
                                class="flex-1"
                                placeholder="Agregar opción..."
                                @keyup.enter="addOption(createForm)"
                            />
                            <PrimaryButton
                                type="button"
                                @click="addOption(createForm)"
                            >
                                Agregar
                            </PrimaryButton>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span
                                v-for="(option, index) in createForm.opciones"
                                :key="index"
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-100 dark:bg-indigo-900/20 text-indigo-800 dark:text-indigo-400"
                            >
                                {{ option }}
                                <button
                                    type="button"
                                    @click="removeOption(createForm, index)"
                                    class="ml-2 text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200"
                                >
                                    ×
                                </button>
                            </span>
                        </div>
                        <InputError
                            :message="createForm.errors.opciones"
                            class="mt-2"
                        />
                    </div>

                    <!-- Requerido -->
                    <div class="flex items-center">
                        <input
                            id="create_es_requerido"
                            v-model="createForm.es_requerido"
                            type="checkbox"
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                        />
                        <InputLabel
                            for="create_es_requerido"
                            value="Campo obligatorio (requerido)"
                            class="ml-2"
                        />
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
                    <span v-else>Crear Campo</span>
                </PrimaryButton>
            </template>
        </DialogModal>

        <!-- Edit Modal (similar structure to create) -->
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
                    Editar Campo
                </div>
            </template>

            <template #content>
                <form @submit.prevent="submitEdit" class="space-y-6">
                    <div>
                        <InputLabel for="edit_etiqueta" value="Etiqueta *" />
                        <TextInput
                            id="edit_etiqueta"
                            v-model="editForm.etiqueta"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError
                            :message="editForm.errors.etiqueta"
                            class="mt-2"
                        />
                    </div>

                    <div>
                        <InputLabel for="edit_nombre_campo" value="Nombre técnico *" />
                        <TextInput
                            id="edit_nombre_campo"
                            v-model="editForm.nombre_campo"
                            type="text"
                            class="mt-1 block w-full font-mono"
                            required
                        />
                        <InputError
                            :message="editForm.errors.nombre_campo"
                            class="mt-2"
                        />
                    </div>

                    <div>
                        <InputLabel value="Tipo de Dato *" />
                        <div class="mt-3 grid grid-cols-2 md:grid-cols-3 gap-3">
                            <button
                                v-for="type in dataTypes"
                                :key="type.value"
                                type="button"
                                @click="editForm.tipo_dato = type.value"
                                :class="[
                                    editForm.tipo_dato === type.value
                                        ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20'
                                        : 'border-gray-200 dark:border-gray-700 hover:border-gray-300',
                                    'relative flex flex-col items-center justify-center p-4 rounded-lg border-2 transition-all duration-200 hover:scale-105',
                                ]"
                            >
                                <span class="text-2xl mb-1">{{
                                    type.icon
                                }}</span>
                                <span
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300"
                                    >{{ type.label }}</span
                                >
                            </button>
                        </div>
                        <InputError
                            :message="editForm.errors.tipo_dato"
                            class="mt-2"
                        />
                    </div>

                    <div v-if="editForm.tipo_dato === 'select'">
                        <InputLabel value="Opciones de la Lista" />
                        <div class="mt-2 flex gap-2">
                            <TextInput
                                v-model="newOption"
                                type="text"
                                class="flex-1"
                                placeholder="Agregar opción..."
                                @keyup.enter="addOption(editForm)"
                            />
                            <PrimaryButton
                                type="button"
                                @click="addOption(editForm)"
                            >
                                Agregar
                            </PrimaryButton>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span
                                v-for="(option, index) in editForm.opciones"
                                :key="index"
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-100 dark:bg-indigo-900/20 text-indigo-800 dark:text-indigo-400"
                            >
                                {{ option }}
                                <button
                                    type="button"
                                    @click="removeOption(editForm, index)"
                                    class="ml-2 text-indigo-600 hover:text-indigo-800"
                                >
                                    ×
                                </button>
                            </span>
                        </div>
                        <InputError
                            :message="editForm.errors.opciones"
                            class="mt-2"
                        />
                    </div>

                    <div class="flex items-center">
                        <input
                            id="edit_es_requerido"
                            v-model="editForm.es_requerido"
                            type="checkbox"
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                        />
                        <InputLabel
                            for="edit_es_requerido"
                            value="Campo obligatorio"
                            class="ml-2"
                        />
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
            <template #title> Eliminar Campo </template>

            <template #content>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    ¿Estás seguro de que deseas eliminar este campo? Esta
                    acción eliminará todos los valores asociados y no se puede
                    deshacer.
                </p>

                <div
                    class="mt-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4"
                >
                    <p
                        class="text-sm font-medium text-yellow-800 dark:text-yellow-200 mb-2"
                    >
                        Para confirmar, escribe la etiqueta del campo:
                    </p>
                    <p
                        class="text-sm font-bold text-yellow-900 dark:text-yellow-100 mb-3"
                    >
                        "{{ selectedField?.etiqueta }}"
                    </p>
                    <TextInput
                        v-model="deleteForm.nombre_confirmacion"
                        type="text"
                        class="w-full"
                        placeholder="Escribe la etiqueta para confirmar"
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
                    <span v-else>Eliminar Campo</span>
                </DangerButton>
            </template>
        </ConfirmationModal>
    </AppLayout>
</template>

<style scoped>
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
</style>

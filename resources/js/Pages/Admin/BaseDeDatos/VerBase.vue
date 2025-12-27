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
import DynamicForm from "./Components/DynamicForm.vue";
import { ref, computed, watch } from "vue";
import { useForm, router, Link } from "@inertiajs/vue3";

const props = defineProps({
    entities: Object,
    fields: Array,
    filters: {
        type: Object,
        default: () => ({}),
    },
});

// Search and filters
const search = ref(props.filters.search || "");
const tipoFilter = ref(props.filters.tipo || "");
let searchTimeout = null;

watch([search, tipoFilter], ([newSearch, newTipo]) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(
            route("entities.index"),
            { search: newSearch, tipo: newTipo },
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
const showDetailModal = ref(false);
const selectedEntity = ref(null);

// Forms
const createForm = useForm({
    tipo: "persona",
    nombre: "",
    apellido: "",
    fields: {},
});

const editForm = useForm({
    tipo: "",
    nombre: "",
    apellido: "",
    fields: {},
});

const deleteForm = useForm({
    nombre_confirmacion: "",
});

// Tipos de entidad
const entityTypes = [
    { value: "persona", label: "Persona", icon: "👤", color: "bg-blue-500" },
    {
        value: "institucion",
        label: "Institución",
        icon: "🏛️",
        color: "bg-purple-500",
    },
    { value: "empresa", label: "Empresa", icon: "🏢", color: "bg-green-500" },
];

// Open modals
const openCreateModal = () => {
    createForm.reset();
    createForm.clearErrors();
    createForm.fields = {};
    showCreateModal.value = true;
};

const openEditModal = (entity) => {
    selectedEntity.value = entity;
    editForm.tipo = entity.tipo;
    editForm.nombre = entity.nombre;
    editForm.apellido = entity.apellido || "";

    // Cargar valores existentes
    editForm.fields = {};
    props.fields.forEach((field) => {
        editForm.fields[field.id] = entity.values[field.nombre_campo] || null;
    });

    editForm.clearErrors();
    showEditModal.value = true;
};

const openDeleteModal = (entity) => {
    selectedEntity.value = entity;
    deleteForm.reset();
    deleteForm.clearErrors();
    showDeleteModal.value = true;
};

const openDetailModal = (entity) => {
    selectedEntity.value = entity;
    showDetailModal.value = true;
};

// Close modals
const closeCreateModal = () => {
    showCreateModal.value = false;
    createForm.reset();
};

const closeEditModal = () => {
    showEditModal.value = false;
    editForm.reset();
    selectedEntity.value = null;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    deleteForm.reset();
    selectedEntity.value = null;
};

const closeDetailModal = () => {
    showDetailModal.value = false;
    selectedEntity.value = null;
};

// Submit handlers
const submitCreate = () => {
    createForm.post(route("entities.store"), {
        preserveScroll: true,
        onSuccess: () => {
            closeCreateModal();
        },
    });
};

const submitEdit = () => {
    editForm.put(route("entities.update", selectedEntity.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            closeEditModal();
        },
    });
};

const submitDelete = () => {
    deleteForm.delete(route("entities.destroy", selectedEntity.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            closeDeleteModal();
        },
    });
};

// Get entity type config
const getEntityTypeConfig = (tipo) => {
    return entityTypes.find((t) => t.value === tipo) || entityTypes[0];
};
</script>

<template>
    <AppLayout title="Base de Datos">
        <template #header>
            <div class="flex justify-between items-center">
                <h2
                    class="font-bold text-2xl text-gray-800 dark:text-white leading-tight"
                >
                    Base de Datos
                </h2>
                <div class="flex items-center gap-4">
                    <Link
                        :href="route('entity-fields.index')"
                        class="text-sm text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 font-medium"
                    >
                        ⚙️ Gestionar Campos
                    </Link>
                    <Link
                        :href="route('excel-import.index')"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        Importar Excel
                    </Link>
                    <a
                        :href="route('entities.export', { tipo: tipoFilter, search: search })"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                        </svg>
                        Exportar Excel
                    </a>
                    <span class="text-sm text-gray-500 dark:text-gray-400"
                        >{{ entities.total }} Registros</span
                    >
                </div>
            </div>
        </template>

        <div class="py-12 min-h-screen bg-gray-50 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Filters -->
                <div class="mb-8 px-4 sm:px-0 space-y-4">
                    <!-- Search Bar -->
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
                            placeholder="Buscar por nombre..."
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-200"
                        />
                    </div>

                    <!-- Type Filter -->
                    <div class="flex gap-2">
                        <button
                            @click="tipoFilter = ''"
                            :class="[
                                tipoFilter === ''
                                    ? 'bg-indigo-600 text-white'
                                    : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700',
                                'px-4 py-2 rounded-lg font-medium text-sm transition-colors duration-200',
                            ]"
                        >
                            Todos
                        </button>
                        <button
                            v-for="type in entityTypes"
                            :key="type.value"
                            @click="tipoFilter = type.value"
                            :class="[
                                tipoFilter === type.value
                                    ? type.color + ' text-white'
                                    : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700',
                                'px-4 py-2 rounded-lg font-medium text-sm transition-colors duration-200 flex items-center gap-2',
                            ]"
                        >
                            <span>{{ type.icon }}</span>
                            <span>{{ type.label }}</span>
                        </button>
                    </div>
                </div>

                <!-- Empty State -->
                <div
                    v-if="!entities.data || entities.data.length === 0"
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
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                        />
                    </svg>
                    <h3
                        class="mt-4 text-lg font-medium text-gray-900 dark:text-white"
                    >
                        No hay registros
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Comienza agregando tu primer registro o importando un
                        Excel
                    </p>
                </div>

                <!-- Table -->
                <div v-else class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                                    >
                                        Tipo
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                                    >
                                        Nombre Completo
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                                    >
                                        Campos Dinámicos
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                                    >
                                        Fecha
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                                    >
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700"
                            >
                                <tr
                                    v-for="entity in entities.data"
                                    :key="entity.id"
                                    class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            :class="[
                                                getEntityTypeConfig(entity.tipo)
                                                    .color,
                                                'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white',
                                            ]"
                                        >
                                            {{
                                                getEntityTypeConfig(entity.tipo)
                                                    .icon
                                            }}
                                            <span class="ml-1">{{
                                                getEntityTypeConfig(entity.tipo)
                                                    .label
                                            }}</span>
                                        </span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"
                                    >
                                        {{ entity.nombre_completo }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400"
                                    >
                                        <div class="flex flex-wrap gap-1">
                                            <span
                                                v-for="(value, key) in Object.fromEntries(
                                                    Object.entries(
                                                        entity.values
                                                    ).filter(
                                                        ([k]) =>
                                                            ![
                                                                'id',
                                                                'tipo',
                                                                'nombre',
                                                                'apellido',
                                                            ].includes(k)
                                                    )
                                                )"
                                                :key="key"
                                                class="inline-flex items-center px-2 py-1 rounded text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300"
                                            >
                                                {{
                                                    value
                                                        ? value.toString().substring(0, 20) +
                                                          (value.toString()
                                                              .length > 20
                                                              ? "..."
                                                              : "")
                                                        : "-"
                                                }}
                                            </span>
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                                    >
                                        {{ entity.created_at }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                    >
                                        <div class="flex justify-end gap-2">
                                            <button
                                                @click="openDetailModal(entity)"
                                                class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200"
                                                title="Ver Detalles"
                                            >
                                                <svg
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                    />
                                                </svg>
                                            </button>
                                            <button
                                                @click="openEditModal(entity)"
                                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200"
                                                title="Editar"
                                            >
                                                <svg
                                                    class="h-5 w-5"
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
                                            </button>
                                            <button
                                                @click="openDeleteModal(entity)"
                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200"
                                                title="Eliminar"
                                            >
                                                <svg
                                                    class="h-5 w-5"
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
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div
                        v-if="entities.data && entities.data.length > 0"
                        class="border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-3 sm:px-6"
                    >
                        <div
                            class="flex items-center justify-between"
                        >
                            <div class="flex flex-1 justify-between sm:hidden">
                                <a
                                    v-if="entities.prev_page_url"
                                    :href="entities.prev_page_url"
                                    class="relative inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
                                >
                                    Anterior
                                </a>
                                <a
                                    v-if="entities.next_page_url"
                                    :href="entities.next_page_url"
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
                                            entities.from
                                        }}</span>
                                        a
                                        <span class="font-medium">{{
                                            entities.to
                                        }}</span>
                                        de
                                        <span class="font-medium">{{
                                            entities.total
                                        }}</span>
                                        resultados
                                    </p>
                                </div>
                                <div>
                                    <nav
                                        class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                                        aria-label="Pagination"
                                    >
                                        <a
                                            v-if="entities.prev_page_url"
                                            :href="entities.prev_page_url"
                                            class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700"
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
                                        <a
                                            v-if="entities.next_page_url"
                                            :href="entities.next_page_url"
                                            class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700"
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
                                    </nav>
                                </div>
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
                    Nuevo Registro
                </span>
            </button>
        </div>

        <!-- Create Modal -->
        <DialogModal
            :show="showCreateModal"
            @close="closeCreateModal"
            max-width="3xl"
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
                    Crear Nuevo Registro
                </div>
            </template>

            <template #content>
                <form @submit.prevent="submitCreate" class="space-y-6">
                    <!-- Tipo -->
                    <div>
                        <InputLabel value="Tipo de Entidad" />
                        <div class="mt-3 grid grid-cols-3 gap-3">
                            <button
                                v-for="type in entityTypes"
                                :key="type.value"
                                type="button"
                                @click="createForm.tipo = type.value"
                                :class="[
                                    createForm.tipo === type.value
                                        ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20'
                                        : 'border-gray-200 dark:border-gray-700 hover:border-gray-300',
                                    'relative flex flex-col items-center justify-center p-4 rounded-lg border-2 transition-all duration-200 hover:scale-105',
                                ]"
                            >
                                <span class="text-3xl mb-2">{{
                                    type.icon
                                }}</span>
                                <span
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300"
                                    >{{ type.label }}</span
                                >
                            </button>
                        </div>
                        <InputError
                            :message="createForm.errors.tipo"
                            class="mt-2"
                        />
                    </div>

                    <!-- Campos Base -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel for="create_nombre" value="Nombre *" />
                            <TextInput
                                id="create_nombre"
                                v-model="createForm.nombre"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError
                                :message="createForm.errors.nombre"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel
                                for="create_apellido"
                                value="Apellido"
                            />
                            <TextInput
                                id="create_apellido"
                                v-model="createForm.apellido"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <InputError
                                :message="createForm.errors.apellido"
                                class="mt-2"
                            />
                        </div>
                    </div>

                    <!-- Campos Dinámicos -->
                    <div v-if="fields && fields.length > 0">
                        <h3
                            class="text-lg font-medium text-gray-900 dark:text-white mb-4"
                        >
                            Campos Adicionales
                        </h3>
                        <DynamicForm
                            :fields="fields"
                            v-model="createForm.fields"
                            :errors="createForm.errors"
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
                    <span v-else>Crear Registro</span>
                </PrimaryButton>
            </template>
        </DialogModal>

        <!-- Edit Modal -->
        <DialogModal
            :show="showEditModal"
            @close="closeEditModal"
            max-width="3xl"
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
                    Editar Registro
                </div>
            </template>

            <template #content>
                <form @submit.prevent="submitEdit" class="space-y-6">
                    <!-- Tipo -->
                    <div>
                        <InputLabel value="Tipo de Entidad" />
                        <div class="mt-3 grid grid-cols-3 gap-3">
                            <button
                                v-for="type in entityTypes"
                                :key="type.value"
                                type="button"
                                @click="editForm.tipo = type.value"
                                :class="[
                                    editForm.tipo === type.value
                                        ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20'
                                        : 'border-gray-200 dark:border-gray-700 hover:border-gray-300',
                                    'relative flex flex-col items-center justify-center p-4 rounded-lg border-2 transition-all duration-200 hover:scale-105',
                                ]"
                            >
                                <span class="text-3xl mb-2">{{
                                    type.icon
                                }}</span>
                                <span
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300"
                                    >{{ type.label }}</span
                                >
                            </button>
                        </div>
                        <InputError
                            :message="editForm.errors.tipo"
                            class="mt-2"
                        />
                    </div>

                    <!-- Campos Base -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel for="edit_nombre" value="Nombre *" />
                            <TextInput
                                id="edit_nombre"
                                v-model="editForm.nombre"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError
                                :message="editForm.errors.nombre"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="edit_apellido" value="Apellido" />
                            <TextInput
                                id="edit_apellido"
                                v-model="editForm.apellido"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <InputError
                                :message="editForm.errors.apellido"
                                class="mt-2"
                            />
                        </div>
                    </div>

                    <!-- Campos Dinámicos -->
                    <div v-if="fields && fields.length > 0">
                        <h3
                            class="text-lg font-medium text-gray-900 dark:text-white mb-4"
                        >
                            Campos Adicionales
                        </h3>
                        <DynamicForm
                            :fields="fields"
                            v-model="editForm.fields"
                            :errors="editForm.errors"
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
            <template #title> Eliminar Registro </template>

            <template #content>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    ¿Estás seguro de que deseas eliminar este registro? Esta
                    acción no se puede deshacer.
                </p>

                <div
                    class="mt-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4"
                >
                    <p
                        class="text-sm font-medium text-yellow-800 dark:text-yellow-200 mb-2"
                    >
                        Para confirmar, escribe el nombre:
                    </p>
                    <p
                        class="text-sm font-bold text-yellow-900 dark:text-yellow-100 mb-3"
                    >
                        "{{ selectedEntity?.nombre }}"
                    </p>
                    <TextInput
                        v-model="deleteForm.nombre_confirmacion"
                        type="text"
                        class="w-full"
                        placeholder="Escribe el nombre para confirmar"
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
                    <span v-else>Eliminar Registro</span>
                </DangerButton>
            </template>
        </ConfirmationModal>

        <!-- Detail Modal -->
        <DialogModal
            :show="showDetailModal"
            @close="closeDetailModal"
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
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    Detalles del Registro
                </div>
            </template>

            <template #content>
                <div v-if="selectedEntity" class="space-y-4">
                    <!-- Tipo -->
                    <div>
                        <h4
                            class="text-sm font-medium text-gray-500 dark:text-gray-400"
                        >
                            Tipo
                        </h4>
                        <p
                            class="mt-1 text-sm text-gray-900 dark:text-white flex items-center gap-2"
                        >
                            <span>{{
                                getEntityTypeConfig(selectedEntity.tipo).icon
                            }}</span>
                            <span>{{
                                getEntityTypeConfig(selectedEntity.tipo).label
                            }}</span>
                        </p>
                    </div>

                    <!-- Nombre Completo -->
                    <div>
                        <h4
                            class="text-sm font-medium text-gray-500 dark:text-gray-400"
                        >
                            Nombre Completo
                        </h4>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ selectedEntity.nombre_completo }}
                        </p>
                    </div>

                    <!-- Campos Dinámicos -->
                    <div
                        v-for="(value, key) in Object.fromEntries(
                            Object.entries(selectedEntity.values).filter(
                                ([k]) =>
                                    !['id', 'tipo', 'nombre', 'apellido'].includes(
                                        k
                                    )
                            )
                        )"
                        :key="key"
                    >
                        <h4
                            class="text-sm font-medium text-gray-500 dark:text-gray-400"
                        >
                            {{
                                key
                                    .split("_")
                                    .map(
                                        (word) =>
                                            word.charAt(0).toUpperCase() +
                                            word.slice(1)
                                    )
                                    .join(" ")
                            }}
                        </h4>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ value || "-" }}
                        </p>
                    </div>

                    <!-- Fecha de Creación -->
                    <div>
                        <h4
                            class="text-sm font-medium text-gray-500 dark:text-gray-400"
                        >
                            Fecha de Creación
                        </h4>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ selectedEntity.created_at }}
                        </p>
                    </div>
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="closeDetailModal">
                    Cerrar
                </SecondaryButton>
                <PrimaryButton class="ml-3" @click="() => {
                    closeDetailModal();
                    openEditModal(selectedEntity);
                }">
                    Editar
                </PrimaryButton>
            </template>
        </DialogModal>
    </AppLayout>
</template>

<style scoped>
/* Smooth animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>

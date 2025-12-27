<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import { ref, computed } from "vue";
import { Link, router } from "@inertiajs/vue3";
import axios from "axios";

// Recibir campos existentes desde el backend
const props = defineProps({
    existingFields: {
        type: Array,
        default: () => [],
    },
});

// Estados del wizard
const currentStep = ref(1);
const uploading = ref(false);
const importing = ref(false);
const uploadedFileData = ref(null);
const existingFields = ref(props.existingFields || []);
const mapping = ref({
    nombre: null,
    apellido: null,
    fields: {},
});
const importOptions = ref({
    tipo: "persona",
    context_id: null,
    rol: null,
});
const importResult = ref(null);
const errorMessage = ref("");

// Archivo seleccionado
const selectedFile = ref(null);
const fileInputRef = ref(null);

// Drag and drop
const isDragging = ref(false);

const handleFileSelect = (event) => {
    const file = event.target.files[0];
    if (file) {
        selectedFile.value = file;
    }
};

const handleDrop = (event) => {
    isDragging.value = false;
    const file = event.dataTransfer.files[0];
    if (file) {
        selectedFile.value = file;
    }
};

const handleDragOver = (event) => {
    event.preventDefault();
    isDragging.value = true;
};

const handleDragLeave = () => {
    isDragging.value = false;
};

const removeFile = () => {
    selectedFile.value = null;
    if (fileInputRef.value) {
        fileInputRef.value.value = "";
    }
};

// Subir archivo
const uploadFile = async () => {
    if (!selectedFile.value) {
        errorMessage.value = "Por favor selecciona un archivo";
        return;
    }

    uploading.value = true;
    errorMessage.value = "";

    const formData = new FormData();
    formData.append("file", selectedFile.value);

    try {
        const response = await axios.post(
            route("excel-import.upload"),
            formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            }
        );

        if (response.data.success) {
            uploadedFileData.value = response.data;
            // Actualizar campos si vienen en la respuesta
            if (response.data.existing_fields) {
                existingFields.value = response.data.existing_fields;
            }
            currentStep.value = 2;
        } else {
            errorMessage.value =
                response.data.message || "Error al procesar el archivo";
        }
    } catch (error) {
        errorMessage.value =
            error.response?.data?.message ||
            "Error al subir el archivo. Verifica el formato.";
    } finally {
        uploading.value = false;
    }
};

// Mapeo de columnas
const getMappingValue = (columnName) => {
    if (mapping.value.nombre === columnName) return "nombre";
    if (mapping.value.apellido === columnName) return "apellido";
    if (mapping.value.fields[columnName]) {
        return "field_" + mapping.value.fields[columnName];
    }
    return "skip";
};

const handleMappingChange = (columnName, value) => {
    // Limpiar mapeos previos de esta columna
    if (mapping.value.nombre === columnName) mapping.value.nombre = null;
    if (mapping.value.apellido === columnName) mapping.value.apellido = null;
    delete mapping.value.fields[columnName];

    // Aplicar nuevo mapeo
    if (value === "nombre") {
        mapping.value.nombre = columnName;
    } else if (value === "apellido") {
        mapping.value.apellido = columnName;
    } else if (value.startsWith("field_")) {
        const fieldId = parseInt(value.replace("field_", ""));
        mapping.value.fields[columnName] = fieldId;
    }
    // Si es "skip", ya limpiamos todo arriba
};

const updateMapping = (columnName, target, fieldId = null) => {
    if (target === "nombre") {
        mapping.value.nombre = columnName;
    } else if (target === "apellido") {
        mapping.value.apellido = columnName;
    } else if (target === "field") {
        if (fieldId) {
            mapping.value.fields[columnName] = fieldId;
        } else {
            delete mapping.value.fields[columnName];
        }
    } else if (target === "skip") {
        // Saltar columna
        delete mapping.value.fields[columnName];
        if (mapping.value.nombre === columnName)
            mapping.value.nombre = null;
        if (mapping.value.apellido === columnName)
            mapping.value.apellido = null;
    }
};

const getMappedTarget = (columnName) => {
    if (mapping.value.nombre === columnName) return "nombre";
    if (mapping.value.apellido === columnName) return "apellido";
    if (mapping.value.fields[columnName]) return "field";
    return "skip";
};

const getMappedFieldId = (columnName) => {
    return mapping.value.fields[columnName] || null;
};

// Crear campos nuevos automáticamente
const creatingFields = ref(false);
const createNewFields = async () => {
    if (!uploadedFileData.value) return;

    // Obtener columnas que no están mapeadas
    const unmappedColumns = uploadedFileData.value.headers
        .map((h) => h.normalized)
        .filter(
            (col) =>
                getMappedTarget(col) === "skip" &&
                col !== "nombre" &&
                col !== "apellido"
        );

    if (unmappedColumns.length === 0) {
        alert("No hay columnas sin mapear");
        return;
    }

    creatingFields.value = true;
    errorMessage.value = "";

    try {
        const response = await axios.post(
            route("excel-import.create-fields"),
            {
                file_path: uploadedFileData.value.file_path,
                columns: unmappedColumns,
            }
        );

        if (response.data.success) {
            // Actualizar campos existentes
            const newFields = response.data.fields;
            newFields.forEach((field) => {
                if (!field.existed) {
                    existingFields.value.push({
                        id: field.id,
                        nombre_campo: field.nombre_campo,
                        etiqueta: field.etiqueta,
                    });
                }
                // Auto-mapear el campo creado
                mapping.value.fields[field.nombre_campo] = field.id;
            });

            alert(
                `Se crearon ${newFields.filter((f) => !f.existed).length} campos nuevos`
            );
        }
    } catch (error) {
        errorMessage.value =
            error.response?.data?.message || "Error al crear campos";
    } finally {
        creatingFields.value = false;
    }
};

// Validar y avanzar al paso 3
const proceedToPreview = () => {
    if (!mapping.value.nombre) {
        errorMessage.value =
            'Debes mapear al menos la columna "Nombre" para continuar';
        return;
    }

    errorMessage.value = "";
    currentStep.value = 3;
};

// Importar datos
const performImport = async () => {
    importing.value = true;
    errorMessage.value = "";

    try {
        const response = await axios.post(route("excel-import.import"), {
            file_path: uploadedFileData.value.file_path,
            mapping: mapping.value,
            options: importOptions.value,
        });

        if (response.data.success) {
            importResult.value = response.data;
            currentStep.value = 4;
        } else {
            errorMessage.value =
                response.data.message || "Error al importar datos";
        }
    } catch (error) {
        errorMessage.value =
            error.response?.data?.message || "Error al importar datos";
    } finally {
        importing.value = false;
    }
};

// Cancelar y limpiar
const cancelImport = async () => {
    if (uploadedFileData.value) {
        try {
            await axios.post(route("excel-import.cancel"), {
                file_path: uploadedFileData.value.file_path,
            });
        } catch (error) {
            console.error("Error al cancelar:", error);
        }
    }

    router.visit(route("entities.index"));
};

// Computados
const canProceedToMapping = computed(() => {
    return selectedFile.value !== null;
});

const canProceedToPreview = computed(() => {
    return mapping.value.nombre !== null;
});

const canImport = computed(() => {
    return mapping.value.nombre !== null;
});

const entityTypes = [
    { value: "persona", label: "Persona", icon: "👤" },
    { value: "institucion", label: "Institución", icon: "🏛️" },
    { value: "empresa", label: "Empresa", icon: "🏢" },
];
</script>

<template>
    <AppLayout title="Importar Excel">
        <template #header>
            <div class="flex justify-between items-center">
                <h2
                    class="font-bold text-2xl text-gray-800 dark:text-white leading-tight"
                >
                    Importar desde Excel
                </h2>
                <Link
                    :href="route('entities.index')"
                    class="text-sm text-gray-600 hover:text-gray-700 dark:text-gray-400 font-medium"
                >
                    ← Volver
                </Link>
            </div>
        </template>

        <div class="py-12 min-h-screen bg-gray-50 dark:bg-gray-900">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <!-- Progress Steps -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div
                            v-for="step in 4"
                            :key="step"
                            class="flex items-center"
                            :class="
                                step < 4
                                    ? 'flex-1'
                                    : ''
                            "
                        >
                            <div
                                :class="[
                                    currentStep >= step
                                        ? 'bg-indigo-600 text-white'
                                        : 'bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400',
                                    'w-10 h-10 rounded-full flex items-center justify-center font-bold',
                                ]"
                            >
                                {{ step }}
                            </div>
                            <div
                                v-if="step < 4"
                                :class="[
                                    currentStep > step
                                        ? 'bg-indigo-600'
                                        : 'bg-gray-200 dark:bg-gray-700',
                                    'h-1 flex-1 mx-2',
                                ]"
                            ></div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-xs text-gray-600 dark:text-gray-400"
                            >Subir</span
                        >
                        <span class="text-xs text-gray-600 dark:text-gray-400"
                            >Mapear</span
                        >
                        <span class="text-xs text-gray-600 dark:text-gray-400"
                            >Vista Previa</span
                        >
                        <span class="text-xs text-gray-600 dark:text-gray-400"
                            >Resultado</span
                        >
                    </div>
                </div>

                <!-- Error Message -->
                <div
                    v-if="errorMessage"
                    class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4"
                >
                    <p class="text-sm text-red-800 dark:text-red-200">
                        {{ errorMessage }}
                    </p>
                </div>

                <!-- Step 1: Upload File -->
                <div
                    v-if="currentStep === 1"
                    class="bg-white dark:bg-gray-800 rounded-lg shadow p-8"
                >
                    <h3
                        class="text-xl font-bold text-gray-900 dark:text-white mb-4"
                    >
                        Paso 1: Subir Archivo Excel
                    </h3>

                    <div
                        v-if="!selectedFile"
                        @drop.prevent="handleDrop"
                        @dragover.prevent="handleDragOver"
                        @dragleave="handleDragLeave"
                        :class="[
                            isDragging
                                ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20'
                                : 'border-gray-300 dark:border-gray-600',
                            'border-2 border-dashed rounded-lg p-12 text-center cursor-pointer transition-colors',
                        ]"
                        @click="$refs.fileInputRef.click()"
                    >
                        <svg
                            class="mx-auto h-16 w-16 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                            />
                        </svg>
                        <p
                            class="mt-4 text-sm text-gray-600 dark:text-gray-400"
                        >
                            Arrastra tu archivo Excel aquí o haz clic para
                            seleccionar
                        </p>
                        <p
                            class="mt-2 text-xs text-gray-500 dark:text-gray-500"
                        >
                            Formatos: .xlsx, .xls, .csv (Máx. 10MB)
                        </p>
                        <input
                            ref="fileInputRef"
                            type="file"
                            accept=".xlsx,.xls,.csv"
                            @change="handleFileSelect"
                            class="hidden"
                        />
                    </div>

                    <!-- Selected File -->
                    <div
                        v-else
                        class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 flex items-center justify-between"
                    >
                        <div class="flex items-center">
                            <svg
                                class="h-8 w-8 text-green-500"
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
                            <div class="ml-3">
                                <p
                                    class="text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    {{ selectedFile.name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{
                                        (selectedFile.size / 1024 / 1024).toFixed(2)
                                    }}
                                    MB
                                </p>
                            </div>
                        </div>
                        <button
                            @click="removeFile"
                            class="text-red-600 hover:text-red-700"
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
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-8 flex justify-end gap-4">
                        <SecondaryButton @click="cancelImport">
                            Cancelar
                        </SecondaryButton>
                        <PrimaryButton
                            @click="uploadFile"
                            :disabled="!canProceedToMapping || uploading"
                        >
                            <span v-if="uploading">Analizando...</span>
                            <span v-else>Continuar →</span>
                        </PrimaryButton>
                    </div>
                </div>

                <!-- Step 2: Map Columns -->
                <div
                    v-if="currentStep === 2"
                    class="bg-white dark:bg-gray-800 rounded-lg shadow p-8"
                >
                    <h3
                        class="text-xl font-bold text-gray-900 dark:text-white mb-4"
                    >
                        Paso 2: Mapear Columnas
                    </h3>

                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        Se encontraron
                        <strong>{{ uploadedFileData.total_rows }}</strong> filas.
                        Mapea las columnas del Excel a los campos del sistema.
                    </p>

                    <div class="mb-6 flex gap-4">
                        <button
                            @click="createNewFields"
                            :disabled="creatingFields"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                        >
                            <span v-if="creatingFields">Creando Campos...</span>
                            <span v-else>✨ Crear Campos Automáticamente</span>
                        </button>
                    </div>

                    <!-- Mapping Table -->
                    <div class="overflow-x-auto">
                        <table
                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                        >
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase"
                                    >
                                        Columna Excel
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase"
                                    >
                                        Vista Previa
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase"
                                    >
                                        Mapear a
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700"
                            >
                                <tr
                                    v-for="(header, index) in uploadedFileData.headers"
                                    :key="index"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"
                                    >
                                        {{ header.original }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400"
                                    >
                                        {{
                                            uploadedFileData.preview_data[0]?.[
                                                index
                                            ] || "-"
                                        }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <select
                                            :value="getMappingValue(header.normalized)"
                                            @change="handleMappingChange(header.normalized, $event.target.value)"
                                            class="block w-full text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:ring-2 focus:ring-indigo-500"
                                        >
                                            <option value="skip">
                                                No usar esta columna
                                            </option>
                                            <option value="nombre">
                                                → Nombre *
                                            </option>
                                            <option value="apellido">
                                                → Apellido
                                            </option>
                                            <optgroup 
                                                v-if="existingFields.length > 0" 
                                                label="─── Campos Dinámicos ───"
                                                class="font-semibold"
                                            >
                                                <option
                                                    v-for="field in existingFields"
                                                    :key="field.id"
                                                    :value="'field_' + field.id"
                                                >
                                                    → {{ field.etiqueta }} ({{ field.tipo_dato }})
                                                </option>
                                            </optgroup>
                                            <option 
                                                v-if="existingFields.length === 0" 
                                                disabled
                                                class="text-gray-400"
                                            >
                                                No hay campos dinámicos
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <SecondaryButton
                            @click="
                                () => {
                                    currentStep = 1;
                                    uploadedFileData = null;
                                }
                            "
                        >
                            ← Atrás
                        </SecondaryButton>
                        <PrimaryButton
                            @click="proceedToPreview"
                            :disabled="!canProceedToPreview"
                        >
                            Continuar →
                        </PrimaryButton>
                    </div>
                </div>

                <!-- Step 3: Preview & Options -->
                <div
                    v-if="currentStep === 3"
                    class="bg-white dark:bg-gray-800 rounded-lg shadow p-8"
                >
                    <h3
                        class="text-xl font-bold text-gray-900 dark:text-white mb-4"
                    >
                        Paso 3: Vista Previa y Opciones
                    </h3>

                    <!-- Opciones de Importación -->
                    <div class="mb-6 space-y-4">
                        <div>
                            <InputLabel value="Tipo de Entidad" />
                            <div class="mt-2 flex gap-3">
                                <button
                                    v-for="type in entityTypes"
                                    :key="type.value"
                                    @click="importOptions.tipo = type.value"
                                    :class="[
                                        importOptions.tipo === type.value
                                            ? 'bg-indigo-600 text-white'
                                            : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300',
                                        'px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2',
                                    ]"
                                >
                                    <span>{{ type.icon }}</span>
                                    <span>{{ type.label }}</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Table -->
                    <div class="mb-6">
                        <h4
                            class="text-lg font-medium text-gray-900 dark:text-white mb-3"
                        >
                            Vista Previa (Primeras 5 filas)
                        </h4>
                        <div class="overflow-x-auto">
                            <table
                                class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm"
                            >
                                <thead class="bg-gray-50 dark:bg-gray-900">
                                    <tr>
                                        <th class="px-4 py-2 text-left">
                                            Nombre
                                        </th>
                                        <th
                                            v-if="mapping.apellido"
                                            class="px-4 py-2 text-left"
                                        >
                                            Apellido
                                        </th>
                                        <th
                                            v-for="(fieldId, colName) in mapping.fields"
                                            :key="colName"
                                            class="px-4 py-2 text-left"
                                        >
                                            {{
                                                existingFields.find(
                                                    (f) => f.id === fieldId
                                                )?.etiqueta || colName
                                            }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700"
                                >
                                    <tr
                                        v-for="(row, rowIndex) in uploadedFileData.preview_data"
                                        :key="rowIndex"
                                    >
                                        <td class="px-4 py-2">
                                            {{
                                                row[
                                                    uploadedFileData.headers.findIndex(
                                                        (h) =>
                                                            h.normalized ===
                                                            mapping.nombre
                                                    )
                                                ] || "-"
                                            }}
                                        </td>
                                        <td
                                            v-if="mapping.apellido"
                                            class="px-4 py-2"
                                        >
                                            {{
                                                row[
                                                    uploadedFileData.headers.findIndex(
                                                        (h) =>
                                                            h.normalized ===
                                                            mapping.apellido
                                                    )
                                                ] || "-"
                                            }}
                                        </td>
                                        <td
                                            v-for="(fieldId, colName) in mapping.fields"
                                            :key="colName"
                                            class="px-4 py-2"
                                        >
                                            {{
                                                row[
                                                    uploadedFileData.headers.findIndex(
                                                        (h) =>
                                                            h.normalized ===
                                                            colName
                                                    )
                                                ] || "-"
                                            }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <SecondaryButton @click="currentStep = 2">
                            ← Atrás
                        </SecondaryButton>
                        <PrimaryButton
                            @click="performImport"
                            :disabled="!canImport || importing"
                        >
                            <span v-if="importing">Importando...</span>
                            <span v-else>Importar Datos</span>
                        </PrimaryButton>
                    </div>
                </div>

                <!-- Step 4: Result -->
                <div
                    v-if="currentStep === 4"
                    class="bg-white dark:bg-gray-800 rounded-lg shadow p-8"
                >
                    <div class="text-center">
                        <svg
                            class="mx-auto h-16 w-16 text-green-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <h3
                            class="mt-4 text-xl font-bold text-gray-900 dark:text-white"
                        >
                            ¡Importación Completada!
                        </h3>
                        <div
                            class="mt-6 grid grid-cols-3 gap-4 max-w-2xl mx-auto"
                        >
                            <div
                                class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4"
                            >
                                <p
                                    class="text-3xl font-bold text-green-600 dark:text-green-400"
                                >
                                    {{ importResult.imported }}
                                </p>
                                <p
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >
                                    Importados
                                </p>
                            </div>
                            <div
                                class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4"
                            >
                                <p
                                    class="text-3xl font-bold text-yellow-600 dark:text-yellow-400"
                                >
                                    {{ importResult.skipped }}
                                </p>
                                <p
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >
                                    Omitidos
                                </p>
                            </div>
                            <div
                                class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4"
                            >
                                <p
                                    class="text-3xl font-bold text-blue-600 dark:text-blue-400"
                                >
                                    {{
                                        importResult.imported +
                                        importResult.skipped
                                    }}
                                </p>
                                <p
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >
                                    Total
                                </p>
                            </div>
                        </div>

                        <!-- Errors -->
                        <div
                            v-if="
                                importResult.errors &&
                                importResult.errors.length > 0
                            "
                            class="mt-6 max-w-2xl mx-auto"
                        >
                            <details
                                class="bg-red-50 dark:bg-red-900/20 rounded-lg p-4"
                            >
                                <summary
                                    class="cursor-pointer font-medium text-red-800 dark:text-red-200"
                                >
                                    Ver errores ({{
                                        importResult.errors.length
                                    }})
                                </summary>
                                <ul class="mt-2 space-y-1 text-sm text-left">
                                    <li
                                        v-for="(error, index) in importResult.errors.slice(
                                            0,
                                            10
                                        )"
                                        :key="index"
                                        class="text-red-700 dark:text-red-300"
                                    >
                                        • {{ error }}
                                    </li>
                                </ul>
                            </details>
                        </div>

                        <div class="mt-8">
                            <PrimaryButton
                                @click="router.visit(route('entities.index'))"
                            >
                                Ver Base de Datos
                            </PrimaryButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
/* Animations */
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

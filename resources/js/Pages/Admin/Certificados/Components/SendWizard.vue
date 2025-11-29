<script setup>
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    certificado: Object,
    variables: Array,
});

const emit = defineEmits(["close"]);

const mode = ref("single"); // single, bulk
const step = ref(1); // 1: Choose Mode, 2: Configure, 3: Review/Send

// Single Send Form
const singleForm = useForm({
    name: "",
    email: "",
    variables: {},
    send_email: true,
});

// Bulk Send Form
const bulkForm = useForm({
    file: null,
    mapping: {
        name: "",
        email: "",
    },
    send_email: true,
});

const excelColumns = ref([]); // To store columns from uploaded file
const previewRows = ref([]); // To preview data

const handleFileUpload = (event) => {
    const file = event.target.files[0];
    bulkForm.file = file;

    // Parse Excel headers (mock implementation for now, ideally backend does this or use a library)
    // For this MVP, we'll just show text inputs for mapping or assume user knows columns
    // In a real app, we'd upload to a temp endpoint to get headers
};

const submitSingle = () => {
    singleForm.post(route("certificados.send.single", props.certificado.id), {
        onSuccess: () => emit("close"),
    });
};

const submitBulk = () => {
    bulkForm.post(route("certificados.send.bulk", props.certificado.id), {
        onSuccess: () => emit("close"),
    });
};
</script>

<template>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
            Enviar Certificado: {{ certificado.nombre }}
        </h2>

        <!-- Tabs -->
        <div class="flex border-b border-gray-200 dark:border-gray-700 mb-6">
            <button
                @click="mode = 'single'"
                :class="{
                    'border-indigo-500 text-indigo-600': mode === 'single',
                    'border-transparent text-gray-500 hover:text-gray-700':
                        mode !== 'single',
                }"
                class="py-2 px-4 border-b-2 font-medium text-sm focus:outline-none"
            >
                Envío Individual
            </button>
            <button
                @click="mode = 'bulk'"
                :class="{
                    'border-indigo-500 text-indigo-600': mode === 'bulk',
                    'border-transparent text-gray-500 hover:text-gray-700':
                        mode !== 'bulk',
                }"
                class="py-2 px-4 border-b-2 font-medium text-sm focus:outline-none"
            >
                Envío Masivo (Excel)
            </button>
        </div>

        <!-- Single Send -->
        <div v-if="mode === 'single'">
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <InputLabel for="name" value="Nombre del Destinatario" />
                    <TextInput
                        id="name"
                        v-model="singleForm.name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError
                        :message="singleForm.errors.name"
                        class="mt-2"
                    />
                </div>
                <div>
                    <InputLabel for="email" value="Correo Electrónico" />
                    <TextInput
                        id="email"
                        v-model="singleForm.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError
                        :message="singleForm.errors.email"
                        class="mt-2"
                    />
                </div>

                <!-- Dynamic Variables -->
                <div
                    v-for="variable in variables"
                    :key="variable.id"
                    v-if="variables.length > 0"
                >
                    <div
                        v-if="
                            !['name', 'Nombre', 'email', 'Email'].includes(
                                variable.name
                            )
                        "
                    >
                        <InputLabel
                            :for="variable.name"
                            :value="variable.name"
                        />
                        <TextInput
                            :id="variable.name"
                            v-model="singleForm.variables[variable.name]"
                            type="text"
                            class="mt-1 block w-full"
                        />
                    </div>
                </div>

                <!-- Email Toggle -->
                <div class="mt-4 flex items-center">
                    <input
                        id="single_send_email"
                        type="checkbox"
                        v-model="singleForm.send_email"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                    />
                    <label
                        for="single_send_email"
                        class="ml-2 block text-sm text-gray-900 dark:text-gray-300"
                    >
                        Enviar correo al destinatario
                    </label>
                </div>

                <div class="flex justify-end mt-4">
                    <SecondaryButton @click="$emit('close')" class="mr-2"
                        >Cancelar</SecondaryButton
                    >
                    <PrimaryButton
                        @click="submitSingle"
                        :class="{ 'opacity-25': singleForm.processing }"
                        :disabled="singleForm.processing"
                    >
                        {{
                            singleForm.send_email
                                ? "Enviar Certificado"
                                : "Generar Certificado"
                        }}
                    </PrimaryButton>
                </div>
            </div>
        </div>

        <!-- Bulk Send -->
        <div v-if="mode === 'bulk'">
            <div class="space-y-4">
                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                    <p class="text-sm text-blue-700 dark:text-blue-300">
                        Sube un archivo Excel (.xlsx) con los datos de los
                        destinatarios. Asegúrate de tener columnas para
                        <strong>Nombre</strong> y <strong>Email</strong>.
                    </p>
                </div>

                <div>
                    <InputLabel value="Archivo Excel" />
                    <input
                        type="file"
                        @change="handleFileUpload"
                        accept=".xlsx,.xls,.csv"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                    />
                    <InputError :message="bulkForm.errors.file" class="mt-2" />
                </div>

                <div
                    class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4"
                >
                    <h4
                        class="text-sm font-medium text-gray-900 dark:text-white mb-2"
                    >
                        Mapeo de Columnas (Nombres en Excel)
                    </h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel value="Columna Nombre" />
                            <TextInput
                                v-model="bulkForm.mapping.name"
                                placeholder="Ej: Nombre Completo"
                                class="mt-1 block w-full"
                            />
                        </div>
                        <div>
                            <InputLabel value="Columna Email" />
                            <TextInput
                                v-model="bulkForm.mapping.email"
                                placeholder="Ej: Correo"
                                class="mt-1 block w-full"
                            />
                        </div>

                        <!-- Dynamic Variable Mapping -->
                        <div v-for="variable in variables" :key="variable.id">
                            <div
                                v-if="
                                    ![
                                        'name',
                                        'Nombre',
                                        'email',
                                        'Email',
                                    ].includes(variable.name)
                                "
                            >
                                <InputLabel
                                    :value="'Columna ' + variable.name"
                                />
                                <TextInput
                                    v-model="bulkForm.mapping[variable.name]"
                                    :placeholder="'Ej: ' + variable.name"
                                    class="mt-1 block w-full"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Email Toggle -->
                <div class="mt-4 flex items-center">
                    <input
                        id="bulk_send_email"
                        type="checkbox"
                        v-model="bulkForm.send_email"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                    />
                    <label
                        for="bulk_send_email"
                        class="ml-2 block text-sm text-gray-900 dark:text-gray-300"
                    >
                        Enviar correos a los destinatarios
                    </label>
                </div>

                <div class="flex justify-end mt-4">
                    <SecondaryButton @click="$emit('close')" class="mr-2"
                        >Cancelar</SecondaryButton
                    >
                    <PrimaryButton
                        @click="submitBulk"
                        :class="{ 'opacity-25': bulkForm.processing }"
                        :disabled="bulkForm.processing"
                    >
                        {{
                            bulkForm.send_email
                                ? "Procesar Envío Masivo"
                                : "Generar Certificados Masivos"
                        }}
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </div>
</template>

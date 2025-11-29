<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    batches: {
        type: Array,
        default: () => [],
    },
    // If provided, we fetch batches from API instead of using props
    certificateId: {
        type: Number,
        default: null,
    },
});

const localBatches = ref([]);
const loading = ref(false);
const selectedBatch = ref(null);
const recipients = ref([]);
const loadingRecipients = ref(false);

const loadBatches = async () => {
    if (!props.certificateId) {
        localBatches.value = props.batches;
        return;
    }

    loading.value = true;
    try {
        const response = await axios.get(
            route("certificados.batches.index", props.certificateId)
        );
        localBatches.value = response.data;
    } catch (error) {
        console.error("Error loading batches", error);
    } finally {
        loading.value = false;
    }
};

const viewBatchDetails = async (batch) => {
    selectedBatch.value = batch;
    loadingRecipients.value = true;
    try {
        const response = await axios.get(
            route("certificados.batches.show", batch.id)
        );
        recipients.value = response.data;
    } catch (error) {
        console.error("Error loading recipients", error);
    } finally {
        loadingRecipients.value = false;
    }
};

const backToBatches = () => {
    selectedBatch.value = null;
    recipients.value = [];
};

const resendForm = useForm({});

const resendEmail = (recipient) => {
    if (confirm(`¿Reenviar correo a ${recipient.email}?`)) {
        resendForm.post(route("certificados.recipients.resend", recipient.id), {
            preserveScroll: true,
            onSuccess: () => {
                alert("Correo reenviado correctamente");
            },
        });
    }
};

onMounted(() => {
    loadBatches();
});
</script>

<template>
    <div class="space-y-4">
        <!-- Batch List -->
        <div v-if="!selectedBatch">
            <div v-if="loading" class="text-center py-4 text-gray-500">
                Cargando historial...
            </div>

            <div
                v-else-if="localBatches.length === 0"
                class="text-center py-4 text-gray-500"
            >
                No hay envíos registrados.
            </div>

            <div v-else class="space-y-3">
                <div
                    v-for="batch in localBatches"
                    :key="batch.id"
                    class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-200 dark:border-gray-600"
                >
                    <div class="flex justify-between items-start">
                        <div>
                            <h4
                                class="font-bold text-gray-800 dark:text-gray-200"
                            >
                                {{ batch.name }}
                            </h4>
                            <p
                                class="text-xs text-gray-500 dark:text-gray-400 mt-1"
                            >
                                {{
                                    new Date(batch.created_at).toLocaleString()
                                }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200"
                            >
                                {{ batch.recipients_count }} destinatarios
                            </span>
                            <button
                                @click="viewBatchDetails(batch)"
                                class="block mt-2 text-xs text-indigo-600 dark:text-indigo-400 hover:underline"
                            >
                                Ver Detalles
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Batch Details (Recipients) -->
        <div v-else>
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <button
                        @click="backToBatches"
                        class="mr-2 text-gray-500 hover:text-gray-700 dark:text-gray-400"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            ></path>
                        </svg>
                    </button>
                    <h3
                        class="font-bold text-gray-800 dark:text-white truncate"
                    >
                        {{ selectedBatch.name }}
                    </h3>
                </div>
                <a
                    :href="
                        route('certificados.batches.export', selectedBatch.id)
                    "
                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                >
                    <svg
                        class="mr-1.5 h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                        />
                    </svg>
                    Exportar Excel
                </a>
            </div>

            <div
                v-if="loadingRecipients"
                class="text-center py-4 text-gray-500"
            >
                Cargando destinatarios...
            </div>

            <div v-else class="overflow-x-auto">
                <table
                    class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                >
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                            >
                                Nombre
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                            >
                                Email
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                            >
                                Estado
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                            >
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700"
                    >
                        <tr v-for="recipient in recipients" :key="recipient.id">
                            <td
                                class="px-3 py-2 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200"
                            >
                                {{ recipient.name }}
                            </td>
                            <td
                                class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                            >
                                {{ recipient.email }}
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    :class="{
                                        'bg-green-100 text-green-800':
                                            recipient.status === 'downloaded',
                                        'bg-blue-100 text-blue-800':
                                            recipient.status === 'sent',
                                        'bg-yellow-100 text-yellow-800':
                                            recipient.status === 'pending',
                                        'bg-gray-100 text-gray-800':
                                            recipient.status === 'generated',
                                    }"
                                >
                                    {{ recipient.status }}
                                </span>
                            </td>
                            <td
                                class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2"
                            >
                                <a
                                    :href="
                                        route(
                                            'certificate.download',
                                            recipient.token
                                        )
                                    "
                                    target="_blank"
                                    class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200"
                                    title="Descargar PDF"
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
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                                        />
                                    </svg>
                                </a>
                                <button
                                    @click="resendEmail(recipient)"
                                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 text-xs"
                                    :disabled="resendForm.processing"
                                    title="Reenviar Correo"
                                >
                                    Reenviar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

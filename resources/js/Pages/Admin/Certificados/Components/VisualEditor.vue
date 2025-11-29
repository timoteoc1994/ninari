<script setup>
import { ref, onMounted, watch } from "vue";
import * as pdfjsLib from "pdfjs-dist";
import "pdfjs-dist/build/pdf.worker.mjs";

const props = defineProps({
    pdfUrl: String,
    initialVariables: {
        type: Array,
        default: () => [],
    },
});

const emit = defineEmits(["save"]);

const canvasRef = ref(null);
const containerRef = ref(null);
const variables = ref([...props.initialVariables]);
const scale = ref(1);
const loading = ref(true);

// Initialize PDF
const initPdf = async () => {
    loading.value = true;
    try {
        // Set worker source
        pdfjsLib.GlobalWorkerOptions.workerSrc = `//cdnjs.cloudflare.com/ajax/libs/pdf.js/${pdfjsLib.version}/pdf.worker.min.js`;

        const loadingTask = pdfjsLib.getDocument(props.pdfUrl);
        const pdf = await loadingTask.promise;
        const page = await pdf.getPage(1);

        const viewport = page.getViewport({ scale: 1.0 });
        const canvas = canvasRef.value;
        const context = canvas.getContext("2d");

        // Calculate scale to fit container width
        const containerWidth = containerRef.value.clientWidth;
        scale.value = containerWidth / viewport.width;

        const scaledViewport = page.getViewport({ scale: scale.value });

        canvas.height = scaledViewport.height;
        canvas.width = scaledViewport.width;

        await page.render({
            canvasContext: context,
            viewport: scaledViewport,
        }).promise;
    } catch (error) {
        console.error("Error loading PDF:", error);
    } finally {
        loading.value = false;
    }
};

// Drag and Drop Logic
const draggingId = ref(null);

const startDrag = (id, event) => {
    draggingId.value = id;
};

const onDrag = (event) => {
    if (draggingId.value === null) return;

    const containerRect = containerRef.value.getBoundingClientRect();
    const x = event.clientX - containerRect.left;
    const y = event.clientY - containerRect.top;

    // Update variable position (convert back to PDF coordinates)
    const variable = variables.value.find((v) => v.id === draggingId.value);
    if (variable) {
        // Center the element on cursor
        variable.x_pos = x / scale.value;
        variable.y_pos = y / scale.value;
    }
};

const stopDrag = () => {
    draggingId.value = null;
};

const addVariable = () => {
    variables.value.push({
        id: Date.now(), // Temporary ID
        name: "Nueva Variable",
        x_pos: 50,
        y_pos: 50,
        font_size: 12,
        font_family: "Arial",
        color: "#000000",
        bold: false,
        italic: false,
        underline: false,
    });
};

const removeVariable = (index) => {
    variables.value.splice(index, 1);
};

const save = () => {
    emit("save", variables.value);
};

onMounted(() => {
    initPdf();
    window.addEventListener("resize", initPdf);
    window.addEventListener("mouseup", stopDrag);
});
</script>

<template>
    <div class="flex flex-col h-full">
        <!-- Toolbar -->
        <div
            class="bg-white dark:bg-gray-800 p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center"
        >
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                Editor de Variables
            </h3>
            <div class="flex gap-2">
                <button
                    @click="addVariable"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm"
                >
                    + Agregar Variable
                </button>
                <button
                    @click="save"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm"
                >
                    Guardar Cambios
                </button>
            </div>
        </div>

        <div class="flex flex-1 overflow-hidden">
            <!-- Sidebar for Variable Properties -->
            <div
                class="w-64 bg-gray-50 dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 p-4 overflow-y-auto"
            >
                <div
                    v-for="(variable, index) in variables"
                    :key="variable.id"
                    class="mb-4 p-3 bg-white dark:bg-gray-800 rounded shadow"
                >
                    <div class="flex justify-between mb-2">
                        <input
                            v-model="variable.name"
                            class="text-sm font-bold bg-transparent border-none p-0 focus:ring-0 w-full"
                        />
                        <button
                            @click="removeVariable(index)"
                            class="text-red-500 hover:text-red-700"
                        >
                            &times;
                        </button>
                    </div>
                    <div class="space-y-2 text-xs">
                        <div>
                            <label class="block text-gray-500 mb-1"
                                >Tipografía</label
                            >
                            <select
                                v-model="variable.font_family"
                                class="w-full rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 text-xs py-1"
                            >
                                <option value="Arial">Arial</option>
                                <option value="Times">Times New Roman</option>
                                <option value="Courier">Courier</option>
                                <option value="Helvetica">Helvetica</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-gray-500 mb-1"
                                    >Tamaño</label
                                >
                                <input
                                    type="number"
                                    v-model="variable.font_size"
                                    class="w-full rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 text-xs py-1"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-500 mb-1"
                                    >Color</label
                                >
                                <input
                                    type="color"
                                    v-model="variable.color"
                                    class="w-full h-6 rounded cursor-pointer"
                                />
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    v-model="variable.bold"
                                    class="rounded border-gray-300"
                                />
                                <span class="font-bold">Negrita</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    v-model="variable.italic"
                                    class="rounded border-gray-300"
                                />
                                <span class="italic">Cursiva</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    v-model="variable.underline"
                                    class="rounded border-gray-300"
                                />
                                <span class="underline">Subrayado</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PDF Canvas Area -->
            <div
                ref="containerRef"
                class="flex-1 bg-gray-200 dark:bg-gray-900 relative overflow-auto flex justify-center p-8"
                @mousemove="onDrag"
            >
                <div
                    class="relative shadow-2xl"
                    :style="{
                        width: canvasRef?.width + 'px',
                        height: canvasRef?.height + 'px',
                    }"
                >
                    <canvas ref="canvasRef" class="block"></canvas>

                    <!-- Draggable Variables -->
                    <div
                        v-for="variable in variables"
                        :key="variable.id"
                        class="absolute cursor-move border-2 border-dashed border-indigo-500 bg-indigo-500/20 hover:bg-indigo-500/40 px-2 py-1 rounded select-none whitespace-nowrap"
                        :style="{
                            left: variable.x_pos * scale + 'px',
                            top: variable.y_pos * scale + 'px',
                            fontSize: variable.font_size * scale + 'px',
                            color: variable.color,
                            fontFamily: variable.font_family,
                            fontWeight: variable.bold ? 'bold' : 'normal',
                            fontStyle: variable.italic ? 'italic' : 'normal',
                            textDecoration: variable.underline
                                ? 'underline'
                                : 'none',
                        }"
                        @mousedown.stop="startDrag(variable.id, $event)"
                    >
                        {{ variable.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

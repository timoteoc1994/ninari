<script setup>
import { ref, computed } from "vue";

const props = defineProps({
    modelValue: File,
    error: String,
    accept: {
        type: String,
        default: "application/pdf",
    },
    maxSize: {
        type: Number,
        default: 5120, // 5MB in KB
    },
});

const emit = defineEmits(["update:modelValue"]);

const fileInput = ref(null);
const selectedFile = ref(null);

const fileSize = computed(() => {
    if (!selectedFile.value) return "";
    const sizeInMB = (selectedFile.value.size / 1024 / 1024).toFixed(2);
    return `${sizeInMB} MB`;
});

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        selectedFile.value = file;
        emit("update:modelValue", file);
    }
};

const clearFile = () => {
    selectedFile.value = null;
    if (fileInput.value) {
        fileInput.value.value = "";
    }
    emit("update:modelValue", null);
};

const triggerFileInput = () => {
    fileInput.value?.click();
};
</script>

<template>
    <div>
        <input
            ref="fileInput"
            type="file"
            :accept="accept"
            @change="handleFileChange"
            class="hidden"
        />

        <div
            @click="triggerFileInput"
            class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors duration-200"
            :class="{ 'border-red-500 dark:border-red-400': error }"
        >
            <div v-if="!selectedFile" class="space-y-2">
                <svg
                    class="mx-auto h-12 w-12 text-gray-400"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 48 48"
                >
                    <path
                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <span
                        class="font-semibold text-indigo-600 dark:text-indigo-400"
                        >Haz clic para subir</span
                    >
                    o arrastra y suelta
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-500">
                    PDF (máx. {{ maxSize / 1024 }}MB)
                </p>
            </div>

            <div v-else class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg
                        class="h-10 w-10 text-red-500"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <div class="text-left">
                        <p
                            class="text-sm font-medium text-gray-900 dark:text-white truncate max-w-xs"
                        >
                            {{ selectedFile.name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ fileSize }}
                        </p>
                    </div>
                </div>
                <button
                    @click.stop="clearFile"
                    type="button"
                    class="ml-4 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                >
                    <svg
                        class="h-5 w-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
            </div>
        </div>

        <p v-if="error" class="mt-2 text-sm text-red-600 dark:text-red-400">
            {{ error }}
        </p>
    </div>
</template>

<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { computed } from "vue";

const props = defineProps({
    fields: {
        type: Array,
        required: true,
    },
    modelValue: {
        type: Object,
        default: () => ({}),
    },
    errors: {
        type: Object,
        default: () => ({}),
    },
});

const emit = defineEmits(["update:modelValue"]);

const localValues = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});

const updateValue = (fieldId, value) => {
    localValues.value = {
        ...localValues.value,
        [fieldId]: value,
    };
};

const getFieldValue = (fieldId) => {
    return localValues.value[fieldId] ?? null;
};
</script>

<template>
    <div class="space-y-4">
        <div
            v-for="field in fields"
            :key="field.id"
            class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-b-0"
        >
            <!-- Text Field -->
            <div v-if="field.tipo_dato === 'text'">
                <InputLabel
                    :for="'field_' + field.id"
                    :value="field.etiqueta + (field.es_requerido ? ' *' : '')"
                />
                <TextInput
                    :id="'field_' + field.id"
                    :model-value="getFieldValue(field.id)"
                    @update:model-value="updateValue(field.id, $event)"
                    type="text"
                    class="mt-1 block w-full"
                    :required="field.es_requerido"
                />
                <InputError
                    :message="errors['fields.' + field.id]"
                    class="mt-2"
                />
            </div>

            <!-- Number Field -->
            <div v-else-if="field.tipo_dato === 'number'">
                <InputLabel
                    :for="'field_' + field.id"
                    :value="field.etiqueta + (field.es_requerido ? ' *' : '')"
                />
                <TextInput
                    :id="'field_' + field.id"
                    :model-value="getFieldValue(field.id)"
                    @update:model-value="updateValue(field.id, $event)"
                    type="number"
                    step="any"
                    class="mt-1 block w-full"
                    :required="field.es_requerido"
                />
                <InputError
                    :message="errors['fields.' + field.id]"
                    class="mt-2"
                />
            </div>

            <!-- Boolean Field -->
            <div v-else-if="field.tipo_dato === 'boolean'">
                <div class="flex items-center">
                    <input
                        :id="'field_' + field.id"
                        :checked="getFieldValue(field.id) === '1' || getFieldValue(field.id) === true"
                        @change="updateValue(field.id, $event.target.checked ? '1' : '0')"
                        type="checkbox"
                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600"
                    />
                    <InputLabel
                        :for="'field_' + field.id"
                        :value="field.etiqueta + (field.es_requerido ? ' *' : '')"
                        class="ml-2"
                    />
                </div>
                <InputError
                    :message="errors['fields.' + field.id]"
                    class="mt-2"
                />
            </div>

            <!-- Date Field -->
            <div v-else-if="field.tipo_dato === 'date'">
                <InputLabel
                    :for="'field_' + field.id"
                    :value="field.etiqueta + (field.es_requerido ? ' *' : '')"
                />
                <TextInput
                    :id="'field_' + field.id"
                    :model-value="getFieldValue(field.id)"
                    @update:model-value="updateValue(field.id, $event)"
                    type="date"
                    class="mt-1 block w-full"
                    :required="field.es_requerido"
                />
                <InputError
                    :message="errors['fields.' + field.id]"
                    class="mt-2"
                />
            </div>

            <!-- Select Field -->
            <div v-else-if="field.tipo_dato === 'select'">
                <InputLabel
                    :for="'field_' + field.id"
                    :value="field.etiqueta + (field.es_requerido ? ' *' : '')"
                />
                <select
                    :id="'field_' + field.id"
                    :value="getFieldValue(field.id)"
                    @change="updateValue(field.id, $event.target.value)"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    :required="field.es_requerido"
                >
                    <option value="">Seleccionar...</option>
                    <option
                        v-for="option in field.opciones"
                        :key="option"
                        :value="option"
                    >
                        {{ option }}
                    </option>
                </select>
                <InputError
                    :message="errors['fields.' + field.id]"
                    class="mt-2"
                />
            </div>
        </div>
    </div>
</template>

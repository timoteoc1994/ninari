<?php

namespace App\Services;

use App\Models\Entity;
use App\Models\EntityField;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EntityImportService
{
    /**
     * Importar entidades desde datos mapeados
     */
    public function importEntities($data, $mapping, $options = [])
    {
        $imported = 0;
        $errors = [];
        $skipped = 0;

        DB::beginTransaction();
        
        try {
            foreach ($data as $rowIndex => $row) {
                try {
                    // Validar que tenga al menos nombre
                    if (!isset($mapping['nombre']) || empty($row[$mapping['nombre']])) {
                        $skipped++;
                        $errors[] = "Fila " . ($rowIndex + 2) . ": Falta el nombre";
                        continue;
                    }

                    // Crear entidad base
                    $entityData = [
                        'tipo' => $options['tipo'] ?? 'persona',
                        'nombre' => $row[$mapping['nombre']],
                        'apellido' => isset($mapping['apellido']) && isset($row[$mapping['apellido']]) 
                            ? $row[$mapping['apellido']] 
                            : null,
                    ];

                    $entity = Entity::create($entityData);

                    // Procesar campos dinámicos
                    if (isset($mapping['fields']) && is_array($mapping['fields'])) {
                        foreach ($mapping['fields'] as $columnName => $fieldId) {
                            $field = EntityField::find($fieldId);
                            
                            if (!$field) continue;

                            $value = $row[$columnName] ?? null;

                            // Si el campo es requerido y no tiene valor, error
                            if ($field->es_requerido && ($value === null || $value === '')) {
                                throw new \Exception("El campo '{$field->etiqueta}' es requerido");
                            }

                            // Guardar valor si existe
                            if ($value !== null && $value !== '') {
                                $normalizedValue = $field->normalizeValue($value);
                                $entity->setFieldValue($field->nombre_campo, $normalizedValue);
                            }
                        }
                    }

                    $imported++;
                } catch (\Exception $e) {
                    $errors[] = "Fila " . ($rowIndex + 2) . ": " . $e->getMessage();
                    $skipped++;
                }
            }

            DB::commit();

            return [
                'success' => true,
                'imported' => $imported,
                'skipped' => $skipped,
                'errors' => $errors,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error importing entities: ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'imported' => 0,
                'skipped' => count($data),
            ];
        }
    }

    /**
     * Crear campos automáticamente desde columnas del Excel
     */
    public function createFieldsFromColumns($columns, $data = [])
    {
        $createdFields = [];

        foreach ($columns as $columnName) {
            // Saltar columnas base (nombre, apellido)
            if (in_array($columnName, ['nombre', 'apellido'])) {
                continue;
            }

            // Verificar si el campo ya existe
            $existingField = EntityField::where('nombre_campo', $columnName)->first();
            
            if ($existingField) {
                $createdFields[] = [
                    'id' => $existingField->id,
                    'nombre_campo' => $existingField->nombre_campo,
                    'etiqueta' => $existingField->etiqueta,
                    'existed' => true,
                ];
                continue;
            }

            // Detectar tipo de dato basado en los valores
            $tipoDato = 'text';
            if (!empty($data)) {
                $columnValues = array_column($data, $columnName);
                $tipoDato = $this->detectColumnType($columnValues);
            }

            // Crear etiqueta legible
            $etiqueta = ucwords(str_replace('_', ' ', $columnName));

            // Crear el campo
            $field = EntityField::create([
                'nombre_campo' => $columnName,
                'etiqueta' => $etiqueta,
                'tipo_dato' => $tipoDato,
                'es_requerido' => false,
                'orden' => EntityField::max('orden') + 1,
            ]);

            $createdFields[] = [
                'id' => $field->id,
                'nombre_campo' => $field->nombre_campo,
                'etiqueta' => $field->etiqueta,
                'existed' => false,
            ];
        }

        return $createdFields;
    }

    /**
     * Detectar tipo de dato basado en valores
     */
    private function detectColumnType($values)
    {
        $nonNullValues = array_filter($values, fn($v) => $v !== null && $v !== '');
        
        if (empty($nonNullValues)) {
            return 'text';
        }

        $sampleSize = min(10, count($nonNullValues));
        $sample = array_slice($nonNullValues, 0, $sampleSize);

        $isNumeric = true;
        $isBoolean = true;
        $isDate = true;

        foreach ($sample as $value) {
            if (!is_numeric($value)) {
                $isNumeric = false;
            }

            $lowerValue = strtolower(trim($value));
            if (!in_array($lowerValue, ['true', 'false', '1', '0', 'si', 'no', 'yes', 'no', 'verdadero', 'falso'], true)) {
                $isBoolean = false;
            }

            if (strtotime($value) === false) {
                $isDate = false;
            }
        }

        if ($isBoolean) return 'boolean';
        if ($isNumeric) return 'number';
        if ($isDate) return 'date';
        
        return 'text';
    }

    /**
     * Validar mapping antes de importar
     */
    public function validateMapping($mapping)
    {
        $errors = [];

        // Verificar que tenga al menos 'nombre'
        if (!isset($mapping['nombre']) || empty($mapping['nombre'])) {
            $errors[] = 'Debe mapear al menos la columna "Nombre"';
        }

        // Validar que los campos existan
        if (isset($mapping['fields']) && is_array($mapping['fields'])) {
            foreach ($mapping['fields'] as $columnName => $fieldId) {
                if (!EntityField::find($fieldId)) {
                    $errors[] = "El campo con ID {$fieldId} no existe";
                }
            }
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors,
        ];
    }
}

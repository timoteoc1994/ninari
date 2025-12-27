<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;

class ExcelReaderService
{
    /**
     * Leer archivo Excel y extraer encabezados y primeras filas
     */
    public function parseExcelFile($filePath, $previewRows = 5)
    {
        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            
            // Obtener encabezados (primera fila)
            $headers = [];
            $highestColumn = $worksheet->getHighestColumn();
            $headerRow = $worksheet->rangeToArray('A1:' . $highestColumn . '1')[0];
            
            foreach ($headerRow as $index => $header) {
                if (!empty($header)) {
                    $headers[] = [
                        'index' => $index,
                        'original' => $header,
                        'normalized' => $this->normalizeHeaderName($header),
                    ];
                }
            }

            // Obtener filas de preview
            $highestRow = min($worksheet->getHighestRow(), $previewRows + 1);
            $data = [];
            
            for ($row = 2; $row <= $highestRow; $row++) {
                $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row)[0];
                $data[] = $rowData;
            }

            // Obtener total de filas (excluyendo encabezado)
            $totalRows = $worksheet->getHighestRow() - 1;

            return [
                'success' => true,
                'headers' => $headers,
                'preview_data' => $data,
                'total_rows' => $totalRows,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Leer todo el contenido del Excel
     */
    public function readAllData($filePath)
    {
        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            
            // Obtener encabezados
            $highestColumn = $worksheet->getHighestColumn();
            $headerRow = $worksheet->rangeToArray('A1:' . $highestColumn . '1')[0];
            
            $headers = [];
            foreach ($headerRow as $index => $header) {
                if (!empty($header)) {
                    $headers[$index] = $this->normalizeHeaderName($header);
                }
            }

            // Obtener todas las filas de datos
            $highestRow = $worksheet->getHighestRow();
            $allData = [];
            
            for ($row = 2; $row <= $highestRow; $row++) {
                $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row)[0];
                
                // Mapear datos con encabezados
                $mappedRow = [];
                foreach ($headers as $index => $header) {
                    $mappedRow[$header] = $rowData[$index] ?? null;
                }
                
                // Solo agregar si la fila tiene al menos un dato
                if (!empty(array_filter($mappedRow))) {
                    $allData[] = $mappedRow;
                }
            }

            return [
                'success' => true,
                'headers' => array_values($headers),
                'data' => $allData,
                'total_rows' => count($allData),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Normalizar nombre de encabezado
     */
    private function normalizeHeaderName($header)
    {
        // Convertir a minúsculas
        $normalized = mb_strtolower(trim($header));
        
        // Reemplazar espacios y caracteres especiales con guiones bajos
        $normalized = preg_replace('/[^a-z0-9]+/', '_', $normalized);
        
        // Eliminar guiones bajos al inicio y final
        $normalized = trim($normalized, '_');
        
        return $normalized;
    }

    /**
     * Detectar tipo de dato de una columna basado en sus valores
     */
    public function detectColumnType($values)
    {
        $nonNullValues = array_filter($values, fn($v) => $v !== null && $v !== '');
        
        if (empty($nonNullValues)) {
            return 'text';
        }

        $isNumeric = true;
        $isBoolean = true;
        $isDate = true;

        foreach ($nonNullValues as $value) {
            // Verificar si es numérico
            if (!is_numeric($value)) {
                $isNumeric = false;
            }

            // Verificar si es booleano
            if (!in_array(strtolower($value), ['true', 'false', '1', '0', 'si', 'no', 'yes', 'no'], true)) {
                $isBoolean = false;
            }

            // Verificar si es fecha
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
     * Validar formato de archivo
     */
    public function validateFile($file)
    {
        $allowedExtensions = ['xlsx', 'xls', 'csv'];
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, $allowedExtensions)) {
            return [
                'valid' => false,
                'message' => 'Formato de archivo no permitido. Use: ' . implode(', ', $allowedExtensions),
            ];
        }

        // Validar tamaño (máximo 10MB)
        if ($file->getSize() > 10 * 1024 * 1024) {
            return [
                'valid' => false,
                'message' => 'El archivo es demasiado grande. Máximo 10MB.',
            ];
        }

        return ['valid' => true];
    }
}

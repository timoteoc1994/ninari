<?php

namespace App\Http\Controllers;

use App\Models\EntityField;
use App\Services\ExcelReaderService;
use App\Services\EntityImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ExcelImportController extends Controller
{
    protected $excelReader;
    protected $importService;

    public function __construct(ExcelReaderService $excelReader, EntityImportService $importService)
    {
        $this->excelReader = $excelReader;
        $this->importService = $importService;
    }

    /**
     * Mostrar vista de importación
     */
    public function index()
    {
        $existingFields = EntityField::ordered()->get(['id', 'nombre_campo', 'etiqueta', 'tipo_dato']);

        return Inertia::render('Admin/BaseDeDatos/ImportarExcel', [
            'existingFields' => $existingFields,
        ]);
    }

    /**
     * Subir y analizar archivo Excel
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $file = $request->file('file');
            
            // Validar archivo
            $validation = $this->excelReader->validateFile($file);
            if (!$validation['valid']) {
                return response()->json([
                    'success' => false,
                    'message' => $validation['message'],
                ], 422);
            }

            // Guardar archivo temporalmente
            $path = $file->store('temp-imports', 'local');
            $fullPath = Storage::disk('local')->path($path);

            // Analizar archivo
            $result = $this->excelReader->parseExcelFile($fullPath, 5);

            if (!$result['success']) {
                Storage::disk('local')->delete($path);
                return response()->json([
                    'success' => false,
                    'message' => 'Error al leer el archivo: ' . $result['error'],
                ], 422);
            }

            // Obtener campos existentes
            $existingFields = EntityField::ordered()->get(['id', 'nombre_campo', 'etiqueta', 'tipo_dato']);

            return response()->json([
                'success' => true,
                'file_path' => $path,
                'headers' => $result['headers'],
                'preview_data' => $result['preview_data'],
                'total_rows' => $result['total_rows'],
                'existing_fields' => $existingFields,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el archivo: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Crear campos automáticamente desde columnas
     */
    public function createFields(Request $request)
    {
        $request->validate([
            'file_path' => 'required|string',
            'columns' => 'required|array',
            'columns.*' => 'string',
        ]);

        try {
            $fullPath = Storage::disk('local')->path($request->file_path);
            
            // Leer todos los datos para detectar tipos
            $fileData = $this->excelReader->readAllData($fullPath);
            
            if (!$fileData['success']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al leer el archivo',
                ], 422);
            }

            // Crear campos
            $createdFields = $this->importService->createFieldsFromColumns(
                $request->columns,
                $fileData['data']
            );

            return response()->json([
                'success' => true,
                'fields' => $createdFields,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear campos: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Importar datos con mapping
     */
    public function import(Request $request)
    {
        $request->validate([
            'file_path' => 'required|string',
            'mapping' => 'required|array',
            'mapping.nombre' => 'required|string',
            'mapping.apellido' => 'nullable|string',
            'mapping.fields' => 'nullable|array',
            'options' => 'nullable|array',
            'options.tipo' => 'nullable|in:persona,institucion,empresa',
            'options.context_id' => 'nullable|exists:contexts,id',
            'options.rol' => 'nullable|in:participante,aliado,beneficiario,mentor',
        ]);

        try {
            // Validar mapping
            $validation = $this->importService->validateMapping($request->mapping);
            if (!$validation['valid']) {
                return response()->json([
                    'success' => false,
                    'message' => implode(', ', $validation['errors']),
                ], 422);
            }

            // Leer datos del archivo
            $fullPath = Storage::disk('local')->path($request->file_path);
            $fileData = $this->excelReader->readAllData($fullPath);

            if (!$fileData['success']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al leer el archivo',
                ], 422);
            }

            // Importar entidades
            $result = $this->importService->importEntities(
                $fileData['data'],
                $request->mapping,
                $request->options ?? []
            );

            // Limpiar archivo temporal
            Storage::disk('local')->delete($request->file_path);

            return response()->json([
                'success' => $result['success'],
                'imported' => $result['imported'],
                'skipped' => $result['skipped'],
                'errors' => $result['errors'],
                'message' => "Se importaron {$result['imported']} registros exitosamente.",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al importar: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Cancelar importación y limpiar archivo temporal
     */
    public function cancel(Request $request)
    {
        $request->validate([
            'file_path' => 'required|string',
        ]);

        try {
            Storage::disk('local')->delete($request->file_path);
            
            return response()->json([
                'success' => true,
                'message' => 'Importación cancelada',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cancelar',
            ], 500);
        }
    }
}

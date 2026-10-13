<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\EntityField;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class EntityController extends Controller
{
    /**
     * Mostrar lista de entidades
     */
    public function index(Request $request)
    {
        $entities = Entity::query()
            ->with(['values.field'])
            ->when($request->search, function ($query, $search) {
                $query->search($search);
            })
            ->when($request->tipo, function ($query, $tipo) {
                $query->ofType($tipo);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString()
            ->through(fn($entity) => [
                'id' => $entity->id,
                'tipo' => $entity->tipo,
                'nombre' => $entity->nombre,
                'apellido' => $entity->apellido,
                'nombre_completo' => $entity->nombre_completo,
                'created_at' => $entity->created_at->format('d/m/Y'),
                'values' => $entity->getAllFieldValues(),
            ]);

        $fields = EntityField::ordered()->get();

        return Inertia::render('BaseDeDatos/VerBase', [
            'entities' => $entities,
            'fields' => $fields,
            'filters' => $request->only(['search', 'tipo']),
        ]);
    }

    /**
     * Crear nueva entidad
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:persona,institucion,empresa',
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'fields' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $entity = Entity::create([
                'tipo' => $validated['tipo'],
                'nombre' => $validated['nombre'],
                'apellido' => $validated['apellido'] ?? null,
            ]);

            // Guardar campos dinámicos
            if (isset($validated['fields'])) {
                foreach ($validated['fields'] as $fieldId => $value) {
                    $field = EntityField::find($fieldId);
                    
                    if ($field) {
                        // Validar campos requeridos
                        if ($field->es_requerido && ($value === null || $value === '')) {
                            throw new \Exception("El campo {$field->etiqueta} es requerido");
                        }

                        // Normalizar y guardar valor
                        if ($value !== null && $value !== '') {
                            $normalizedValue = $field->normalizeValue($value);
                            $entity->setFieldValue($field->nombre_campo, $normalizedValue);
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Entidad creada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Actualizar entidad existente
     */
    public function update(Request $request, Entity $entity)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:persona,institucion,empresa',
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'fields' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $entity->update([
                'tipo' => $validated['tipo'],
                'nombre' => $validated['nombre'],
                'apellido' => $validated['apellido'] ?? null,
            ]);

            // Actualizar campos dinámicos
            if (isset($validated['fields'])) {
                foreach ($validated['fields'] as $fieldId => $value) {
                    $field = EntityField::find($fieldId);
                    
                    if ($field) {
                        // Validar campos requeridos
                        if ($field->es_requerido && ($value === null || $value === '')) {
                            throw new \Exception("El campo {$field->etiqueta} es requerido");
                        }

                        // Normalizar y guardar valor
                        $normalizedValue = $value !== null && $value !== '' 
                            ? $field->normalizeValue($value) 
                            : null;
                            
                        $entity->setFieldValue($field->nombre_campo, $normalizedValue);
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Entidad actualizada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Eliminar entidad
     */
    public function destroy(Request $request, Entity $entity)
    {
        $request->validate([
            'nombre_confirmacion' => 'required|string|in:' . $entity->nombre,
        ]);

        $entity->delete();

        return redirect()->back()->with('success', 'Entidad eliminada exitosamente');
    }

    /**
     * Obtener detalle de una entidad (API)
     */
    public function show(Entity $entity)
    {
        return response()->json([
            'entity' => $entity->load(['values.field', 'contexts']),
            'all_values' => $entity->getAllFieldValues(),
        ]);
    }

    /**
     * Exportar entidades a Excel
     */
    public function export(Request $request)
    {
        $entities = Entity::query()
            ->with(['values.field'])
            ->when($request->tipo, function ($query, $tipo) {
                $query->ofType($tipo);
            })
            ->when($request->search, function ($query, $search) {
                $query->search($search);
            })
            ->latest()
            ->get();

        $fields = EntityField::ordered()->get();

        // Preparar datos para el Excel
        $exportData = [];
        
        // Encabezados
        $headers = ['Tipo', 'Nombre', 'Apellido'];
        foreach ($fields as $field) {
            $headers[] = $field->etiqueta;
        }
        $exportData[] = $headers;

        // Datos de las entidades
        foreach ($entities as $entity) {
            $row = [
                ucfirst($entity->tipo),
                $entity->nombre,
                $entity->apellido ?? '',
            ];

            $allValues = $entity->getAllFieldValues();
            foreach ($fields as $field) {
                $value = $allValues[$field->nombre_campo] ?? '';
                
                // Formatear valores booleanos
                if ($field->tipo_dato === 'boolean') {
                    $value = $value ? 'Sí' : 'No';
                } elseif ($field->tipo_dato === 'date' && $value) {
                    $value = date('d/m/Y', strtotime($value));
                }
                
                $row[] = $value;
            }

            $exportData[] = $row;
        }

        // Crear el archivo Excel usando PhpSpreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Establecer los datos
        $sheet->fromArray($exportData, null, 'A1');
        
        // Estilizar encabezados
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F46E5']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        ];
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray($headerStyle);
        
        // Ajustar ancho de columnas
        foreach (range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Generar el archivo
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $fileName = 'entidades_' . date('Y-m-d_His') . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\EntityField;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EntityFieldController extends Controller
{
    /**
     * Mostrar lista de campos
     */
    public function index(Request $request)
    {
        $fields = EntityField::query()
            ->when($request->search, function ($query, $search) {
                $query->where('nombre_campo', 'like', "%{$search}%")
                    ->orWhere('etiqueta', 'like', "%{$search}%");
            })
            ->ordered()
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('Admin/BaseDeDatos/VerCampos', [
            'fields' => $fields,
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Crear nuevo campo
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_campo' => 'required|string|max:255|unique:entity_fields',
            'etiqueta' => 'required|string|max:255',
            'tipo_dato' => 'required|in:text,number,boolean,date,select',
            'opciones' => 'nullable|array',
            'es_requerido' => 'boolean',
            'orden' => 'integer',
        ]);

        EntityField::create($validated);

        return redirect()->back()->with('success', 'Campo creado exitosamente');
    }

    /**
     * Actualizar campo existente
     */
    public function update(Request $request, EntityField $field)
    {
        $validated = $request->validate([
            'nombre_campo' => 'required|string|max:255|unique:entity_fields,nombre_campo,' . $field->id,
            'etiqueta' => 'required|string|max:255',
            'tipo_dato' => 'required|in:text,number,boolean,date,select',
            'opciones' => 'nullable|array',
            'es_requerido' => 'boolean',
            'orden' => 'integer',
        ]);

        $field->update($validated);

        return redirect()->back()->with('success', 'Campo actualizado exitosamente');
    }

    /**
     * Eliminar campo
     */
    public function destroy(Request $request, EntityField $field)
    {
        $request->validate([
            'nombre_confirmacion' => 'required|string|in:' . $field->etiqueta,
        ]);

        $field->delete();

        return redirect()->back()->with('success', 'Campo eliminado exitosamente');
    }

    /**
     * Obtener todos los campos (API)
     */
    public function getAllFields()
    {
        return response()->json(
            EntityField::ordered()->get()
        );
    }
}

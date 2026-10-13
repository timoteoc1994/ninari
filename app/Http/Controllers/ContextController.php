<?php

namespace App\Http\Controllers;

use App\Models\Context;
use App\Models\Entity;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContextController extends Controller
{
    /**
     * Mostrar lista de contextos
     */
    public function index(Request $request)
    {
        $contexts = Context::query()
            ->withCount('entities')
            ->when($request->search, function ($query, $search) {
                $query->search($search);
            })
            ->when($request->tipo, function ($query, $tipo) {
                $query->ofType($tipo);
            })
            ->when($request->year, function ($query, $year) {
                $query->ofYear($year);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('BaseDeDatos/VerContextos', [
            'contexts' => $contexts,
            'filters' => $request->only(['search', 'tipo', 'year']),
        ]);
    }

    /**
     * Crear nuevo contexto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'year' => 'nullable|string|max:4',
            'tipo' => 'required|in:proyecto,programa,convocatoria',
            'descripcion' => 'nullable|string',
        ]);

        Context::create($validated);

        return redirect()->back()->with('success', 'Contexto creado exitosamente');
    }

    /**
     * Actualizar contexto
     */
    public function update(Request $request, Context $context)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'year' => 'nullable|string|max:4',
            'tipo' => 'required|in:proyecto,programa,convocatoria',
            'descripcion' => 'nullable|string',
        ]);

        $context->update($validated);

        return redirect()->back()->with('success', 'Contexto actualizado exitosamente');
    }

    /**
     * Eliminar contexto
     */
    public function destroy(Request $request, Context $context)
    {
        $request->validate([
            'nombre_confirmacion' => 'required|string|in:' . $context->nombre,
        ]);

        $context->delete();

        return redirect()->back()->with('success', 'Contexto eliminado exitosamente');
    }

    /**
     * Asignar entidades a un contexto
     */
    public function attachEntities(Request $request, Context $context)
    {
        $validated = $request->validate([
            'entity_ids' => 'required|array',
            'entity_ids.*' => 'exists:entities,id',
            'rol' => 'required|in:participante,aliado,beneficiario,mentor',
        ]);

        foreach ($validated['entity_ids'] as $entityId) {
            $context->entities()->syncWithoutDetaching([
                $entityId => ['rol' => $validated['rol']]
            ]);
        }

        return redirect()->back()->with('success', 'Entidades asignadas exitosamente');
    }

    /**
     * Desasignar entidad de un contexto
     */
    public function detachEntity(Context $context, Entity $entity)
    {
        $context->entities()->detach($entity->id);

        return redirect()->back()->with('success', 'Entidad removida del contexto');
    }

    /**
     * Ver entidades de un contexto
     */
    public function showEntities(Context $context)
    {
        $entities = $context->entities()
            ->with(['values.field'])
            ->get()
            ->map(fn($entity) => [
                'id' => $entity->id,
                'tipo' => $entity->tipo,
                'nombre' => $entity->nombre,
                'apellido' => $entity->apellido,
                'nombre_completo' => $entity->nombre_completo,
                'rol' => $entity->pivot->rol,
                'values' => $entity->getAllFieldValues(),
            ]);

        return Inertia::render('BaseDeDatos/VerContextoEntidades', [
            'context' => $context,
            'entities' => $entities,
        ]);
    }
}

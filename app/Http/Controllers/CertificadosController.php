<?php

namespace App\Http\Controllers;

use App\Models\Certificados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CertificadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $certificados = Certificados::with(['user', 'variables'])
            ->when($search, function ($query, $search) {
                return $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(12)
            ->through(function ($cert) {
                return [
                    'id' => $cert->id,
                    'nombre' => $cert->nombre,
                    'creator' => $cert->creator_name,
                    'badge' => $cert->badge,
                    'color' => $cert->color,
                    'pdf_url' => Storage::url($cert->pdf_url),
                    'user_id' => $cert->user_id,
                    'variables' => $cert->variables,
                ];
            });

        return Inertia::render('Admin/Certificados/VerCertificados', [
            'certificados' => $certificados,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'badge' => 'required|string|max:50',
            'color' => 'required|string|max:50',
            'pdf_file' => 'required|file|mimes:pdf|max:10120', // 5MB max
        ]);

        // Handle PDF upload
        $pdfPath = $request->file('pdf_file')->store('certificados', 'public');

        // Create certificate
        Certificados::create([
            'nombre' => $validated['nombre'],
            'user_id' => auth()->id(),
            'badge' => $validated['badge'],
            'color' => $validated['color'],
            'pdf_url' => $pdfPath,
        ]);

        return redirect()->route('certificados.index')->with('success', 'Certificado creado exitosamente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificados $certificado)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'badge' => 'required|string|max:50',
            'color' => 'required|string|max:50',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10S120',
        ]);

        if ($request->hasFile('pdf_file')) {
            if (Storage::disk('public')->exists($certificado->pdf_url)) {
                Storage::disk('public')->delete($certificado->pdf_url);
            }

            $validated['pdf_url'] = $request->file('pdf_file')->store('certificados', 'public');
        }

        $certificado->update([
            'nombre' => $validated['nombre'],
            'badge' => $validated['badge'],
            'color' => $validated['color'],
            'pdf_url' => $validated['pdf_url'] ?? $certificado->pdf_url,
        ]);

        return redirect()->route('certificados.index')
            ->with('success', 'Certificado actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Certificados $certificado)
    {

        // Check if user is the creator
        if ($certificado->user_id !== auth()->id()) {
            return back()->withErrors(['error' => 'No tienes permiso para eliminar este certificado']);
        }

        // Validate certificate name confirmation
        $request->validate([
            'nombre_confirmacion' => 'required|string',
        ]);

        if ($request->nombre_confirmacion !== $certificado->nombre) {
            return back()->withErrors(['nombre_confirmacion' => 'El nombre del certificado no coincide']);
        }

        // Delete PDF file
        if (Storage::disk('public')->exists($certificado->pdf_url)) {
            Storage::disk('public')->delete($certificado->pdf_url);
        }

        // Delete certificate record
        $certificado->delete();

        return redirect()->route('certificados.index')->with('success', 'Certificado eliminado exitosamente');
    }
}

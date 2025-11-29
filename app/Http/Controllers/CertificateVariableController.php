<?php

namespace App\Http\Controllers;

use App\Models\Certificados;
use App\Models\CertificateVariable;
use Illuminate\Http\Request;

class CertificateVariableController extends Controller
{
    public function store(Request $request, Certificados $certificado)
    {
        $validated = $request->validate([
            'variables' => 'required|array',
            'variables.*.name' => 'required|string',
            'variables.*.x_pos' => 'required|numeric',
            'variables.*.y_pos' => 'required|numeric',
            'variables.*.font_size' => 'required|integer',
            'variables.*.font_family' => 'required|string',
            'variables.*.color' => 'required|string',
            'variables.*.bold' => 'boolean',
            'variables.*.italic' => 'boolean',
            'variables.*.underline' => 'boolean',
        ]);

        // Delete existing variables for this certificate to replace with new ones
        // This is a simple approach; for more complex needs, we might want to update individually
        $certificado->variables()->delete();

        foreach ($validated['variables'] as $variable) {
            $certificado->variables()->create($variable);
        }

        return back()->with('success', 'Variables guardadas correctamente');
    }

    public function index(Certificados $certificado)
    {
        return response()->json($certificado->variables);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mail3;

class ContactoController extends Controller
{
    public function contacto_guardar(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'mensaje' => 'required|string',
        ]);

        // Guardar el mensaje en la base de datos
        Contacto::create($validated);

        // Enviar el correo con los datos del formulario
        Mail::to('edgartimoteo@gmail.com')->send(new Mail3(
            $validated['nombre'],
            $validated['email'],
            $validated['mensaje']
        ));

        // Redirigir con un mensaje de éxito
        return back()->with('success', 'Tu mensaje ha sido enviado correctamente.');
    }
}

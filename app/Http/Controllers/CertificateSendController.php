<?php

namespace App\Http\Controllers;

use App\Jobs\SendCertificateEmail;
use App\Models\Certificados;
use App\Models\CertificateBatch;
use App\Services\ExcelImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CertificateSendController extends Controller
{
    public function sendSingle(Request $request, Certificados $certificado)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'variables' => 'nullable|array',
            'send_email' => 'boolean',
        ]);

        $sendEmail = $request->boolean('send_email', true);

        // Create a batch for this single send with variable snapshot
        $batch = $certificado->batches()->create([
            'user_id' => auth()->id(),
            'name' => 'Envío Individual - ' . now()->format('d/m/Y H:i'),
            'variable_config' => $certificado->variables, // Save snapshot of variables
        ]);

        // Create recipient
        $recipient = $batch->recipients()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'token' => Str::uuid(),
            'variable_data' => $validated['variables'] ?? [],
            'status' => $sendEmail ? 'pending' : 'generated',
        ]);

        // Dispatch job only if send_email is true
        if ($sendEmail) {
            SendCertificateEmail::dispatch($recipient);
            $message = 'Certificado enviado correctamente';
        } else {
            $message = 'Certificado generado correctamente (sin envío de correo)';
        }

        return back()->with('success', $message);
    }

    public function sendBulk(Request $request, Certificados $certificado)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
            'mapping' => 'required|array', // Maps excel columns to variables
            'send_email' => 'boolean',
        ]);

        $file = $request->file('file');
        $mapping = $request->input('mapping');
        $sendEmail = $request->boolean('send_email', true);

        // Import Excel
        $import = new ExcelImportService();
        $rows = Excel::toArray($import, $file)[0];

        if (count($rows) === 0) {
            return back()->withErrors(['file' => 'El archivo está vacío']);
        }

        // Validate columns
        $headerRow = array_keys($rows[0]);
        $missingColumns = [];

        foreach ($mapping as $key => $column) {
            if (!in_array($column, $headerRow)) {
                $missingColumns[] = $column;
            }
        }

        if (!empty($missingColumns)) {
            return back()->withErrors(['file' => 'Las siguientes columnas no existen en el archivo: ' . implode(', ', $missingColumns)]);
        }

        // Create batch with variable snapshot
        $batch = $certificado->batches()->create([
            'user_id' => auth()->id(),
            'name' => 'Envío Masivo - ' . $file->getClientOriginalName(),
            'variable_config' => $certificado->variables, // Save snapshot of variables
        ]);

        $count = 0;
        foreach ($rows as $row) {
            // Basic validation - skip empty rows
            if (empty($row)) continue;

            // Extract data based on mapping
            $recipientData = [
                'name' => $row[$mapping['name']] ?? 'Sin Nombre',
                'email' => $row[$mapping['email']] ?? null,
                'token' => Str::uuid(),
                'status' => $sendEmail ? 'pending' : 'generated',
                'variable_data' => [],
            ];

            if (!$recipientData['email']) continue; // Skip if no email

            // Map other variables
            foreach ($mapping as $key => $column) {
                if ($key !== 'name' && $key !== 'email') {
                    $recipientData['variable_data'][$key] = $row[$column] ?? '';
                }
            }

            $recipient = $batch->recipients()->create($recipientData);

            // Dispatch job only if send_email is true
            if ($sendEmail) {
                SendCertificateEmail::dispatch($recipient);
            }

            $count++;
        }

        $message = $sendEmail
            ? "Se han procesado {$count} destinatarios. El envío ha comenzado."
            : "Se han generado {$count} certificados correctamente.";

        return back()->with('success', $message);
    }
}

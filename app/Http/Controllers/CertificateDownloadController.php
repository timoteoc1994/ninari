<?php

namespace App\Http\Controllers;

use App\Models\CertificateRecipient;
use App\Services\PdfService;
use Illuminate\Http\Request;

class CertificateDownloadController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function download($token)
    {
        $recipient = CertificateRecipient::where('token', $token)->firstOrFail();
        $batch = $recipient->batch;
        $certificado = $batch->certificado;

        // Use the saved variable configuration from the batch (snapshot at send time)
        // This ensures the PDF is generated with the same variable names/positions
        // even if the certificate's variables have been modified since
        $variables = collect($batch->variable_config ?? $certificado->variables);

        // Prepare variables for PDF generation
        $pdfVariables = [];

        // Add Name (standard variable)
        // Find if there's a variable config for 'name' or 'Nombre'
        $nameVarConfig = $variables->whereIn('name', ['name', 'Nombre'])->first();
        if ($nameVarConfig) {
            $nameVarData = is_array($nameVarConfig) ? (object)$nameVarConfig : $nameVarConfig;
            $pdfVariables[] = [
                'text' => $recipient->name,
                'x_pos' => $nameVarData->x_pos,
                'y_pos' => $nameVarData->y_pos,
                'font_size' => $nameVarData->font_size,
                'font_family' => $nameVarData->font_family ?? 'Arial',
                'color' => $nameVarData->color,
                'bold' => $nameVarData->bold ?? false,
                'italic' => $nameVarData->italic ?? false,
                'underline' => $nameVarData->underline ?? false,
            ];
        }

        // Add other dynamic variables
        if ($recipient->variable_data) {
            foreach ($recipient->variable_data as $key => $value) {
                $config = $variables->where('name', $key)->first();
                if ($config) {
                    $configData = is_array($config) ? (object)$config : $config;
                    $pdfVariables[] = [
                        'text' => $value,
                        'x_pos' => $configData->x_pos,
                        'y_pos' => $configData->y_pos,
                        'font_size' => $configData->font_size,
                        'font_family' => $configData->font_family ?? 'Arial',
                        'color' => $configData->color,
                        'bold' => $configData->bold ?? false,
                        'italic' => $configData->italic ?? false,
                        'underline' => $configData->underline ?? false,
                    ];
                }
            }
        }

        // Generate PDF
        $pdfContent = $this->pdfService->generate($certificado->pdf_url, $pdfVariables);

        // Update status
        if ($recipient->status !== 'downloaded') {
            $recipient->update([
                'status' => 'downloaded',
                'downloaded_at' => now(),
            ]);
        }

        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $certificado->nombre . '.pdf"');
    }
}

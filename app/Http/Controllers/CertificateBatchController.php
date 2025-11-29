<?php

namespace App\Http\Controllers;

use App\Jobs\SendCertificateEmail;
use App\Models\CertificateBatch;
use App\Models\CertificateRecipient;
use App\Models\Certificados;
use Illuminate\Http\Request;

class CertificateBatchController extends Controller
{
    public function index(Certificados $certificado)
    {
        return $certificado->batches()
            ->withCount('recipients')
            ->latest()
            ->get();
    }

    public function show(CertificateBatch $batch)
    {
        return $batch->recipients()
            ->latest()
            ->get();
    }

    public function resend(CertificateRecipient $recipient)
    {
        // Dispatch job again
        SendCertificateEmail::dispatch($recipient);

        return back()->with('success', 'Correo reenviado correctamente');
    }

    public function export(CertificateBatch $batch)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\BatchExport($batch), 'reporte-envio-' . $batch->id . '.xlsx');
    }
}

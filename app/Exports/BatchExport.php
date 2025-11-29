<?php

namespace App\Exports;

use App\Models\CertificateBatch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BatchExport implements FromCollection, WithHeadings, WithMapping
{
    protected $batch;

    public function __construct(CertificateBatch $batch)
    {
        $this->batch = $batch;
    }

    public function collection()
    {
        return $this->batch->recipients;
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Email',
            'Estado',
            'Fecha de Envío',
            'Link de Descarga',
        ];
    }

    public function map($recipient): array
    {
        return [
            $recipient->name,
            $recipient->email,
            $recipient->status,
            $recipient->sent_at ? $recipient->sent_at->format('d/m/Y H:i') : 'Pendiente',
            route('certificate.download', ['token' => $recipient->token]),
        ];
    }
}

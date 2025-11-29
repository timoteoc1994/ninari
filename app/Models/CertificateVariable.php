<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateVariable extends Model
{
    protected $fillable = [
        'certificado_id',
        'name',
        'x_pos',
        'y_pos',
        'font_size',
        'font_family',
        'color',
        'bold',
        'italic',
        'underline',
    ];

    public function certificado()
    {
        return $this->belongsTo(Certificados::class);
    }
}

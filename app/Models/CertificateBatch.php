<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateBatch extends Model
{
    protected $fillable = [
        'certificado_id',
        'user_id',
        'name',
        'variable_config',
    ];

    protected $casts = [
        'variable_config' => 'array',
    ];

    public function certificado()
    {
        return $this->belongsTo(Certificados::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipients()
    {
        return $this->hasMany(CertificateRecipient::class, 'batch_id');
    }
}

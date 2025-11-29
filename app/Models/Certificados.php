<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificados extends Model
{
    protected $table = 'certificados';
    protected $fillable = [
        'nombre',
        'user_id',
        'badge',
        'color',
        'pdf_url',
    ];

    /**
     * Get the user that created the certificate
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get the creator's name
     */
    public function getCreatorNameAttribute()
    {
        return $this->user ? $this->user->name : 'Unknown';
    }

    public function variables()
    {
        return $this->hasMany(CertificateVariable::class, 'certificado_id');
    }

    public function batches()
    {
        return $this->hasMany(CertificateBatch::class, 'certificado_id');
    }
}

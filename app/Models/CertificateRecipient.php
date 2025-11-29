<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateRecipient extends Model
{
    protected $fillable = [
        'batch_id',
        'name',
        'email',
        'status',
        'token',
        'variable_data',
        'downloaded_at',
    ];

    protected $casts = [
        'variable_data' => 'array',
        'downloaded_at' => 'datetime',
    ];

    public function batch()
    {
        return $this->belongsTo(CertificateBatch::class, 'batch_id');
    }
}

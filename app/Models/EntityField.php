<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityField extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_campo',
        'etiqueta',
        'tipo_dato',
        'opciones',
        'es_requerido',
        'orden',
    ];

    protected $casts = [
        'opciones' => 'array',
        'es_requerido' => 'boolean',
    ];

    /**
     * Relación con valores
     */
    public function values()
    {
        return $this->hasMany(EntityValue::class, 'field_id');
    }

    /**
     * Scope para ordenar por orden
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('orden')->orderBy('etiqueta');
    }

    /**
     * Scope para campos requeridos
     */
    public function scopeRequired($query)
    {
        return $query->where('es_requerido', true);
    }

    /**
     * Validar valor según el tipo de dato
     */
    public function validateValue($value)
    {
        if ($value === null && !$this->es_requerido) {
            return true;
        }

        if ($value === null && $this->es_requerido) {
            return false;
        }

        switch ($this->tipo_dato) {
            case 'number':
                return is_numeric($value);
            case 'boolean':
                return in_array($value, [true, false, 1, 0, '1', '0', 'true', 'false'], true);
            case 'date':
                return strtotime($value) !== false;
            case 'select':
                return $this->opciones && in_array($value, $this->opciones);
            case 'text':
            default:
                return true;
        }
    }

    /**
     * Normalizar valor según el tipo de dato
     */
    public function normalizeValue($value)
    {
        if ($value === null) {
            return null;
        }

        switch ($this->tipo_dato) {
            case 'number':
                return is_numeric($value) ? (string) $value : null;
            case 'boolean':
                return in_array($value, [true, 1, '1', 'true'], true) ? '1' : '0';
            case 'date':
                $timestamp = strtotime($value);
                return $timestamp ? date('Y-m-d', $timestamp) : null;
            case 'text':
            case 'select':
            default:
                return (string) $value;
        }
    }
}

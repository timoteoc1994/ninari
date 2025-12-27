<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'field_id',
        'valor',
    ];

    /**
     * Relación con la entidad
     */
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    /**
     * Relación con el campo
     */
    public function field()
    {
        return $this->belongsTo(EntityField::class);
    }

    /**
     * Obtener valor formateado según el tipo de dato
     */
    public function getFormattedValueAttribute()
    {
        if ($this->valor === null) {
            return null;
        }

        switch ($this->field->tipo_dato) {
            case 'number':
                return is_numeric($this->valor) ? (float) $this->valor : null;
            case 'boolean':
                return $this->valor === '1' || $this->valor === true;
            case 'date':
                return $this->valor;
            case 'text':
            case 'select':
            default:
                return $this->valor;
        }
    }
}

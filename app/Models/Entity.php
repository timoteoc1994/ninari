<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'nombre',
        'apellido',
    ];

    /**
     * Relación con valores dinámicos
     */
    public function values()
    {
        return $this->hasMany(EntityValue::class);
    }

    /**
     * Relación con contextos (proyectos, programas, etc.)
     */
    public function contexts()
    {
        return $this->belongsToMany(Context::class, 'entity_context')
            ->withPivot('rol')
            ->withTimestamps();
    }

    /**
     * Obtener valor de un campo específico
     */
    public function getFieldValue($fieldName)
    {
        $field = EntityField::where('nombre_campo', $fieldName)->first();
        
        if (!$field) {
            return null;
        }

        $value = $this->values()
            ->where('field_id', $field->id)
            ->first();

        return $value ? $value->valor : null;
    }

    /**
     * Establecer valor de un campo específico
     */
    public function setFieldValue($fieldName, $value)
    {
        $field = EntityField::where('nombre_campo', $fieldName)->first();
        
        if (!$field) {
            return false;
        }

        return $this->values()->updateOrCreate(
            ['field_id' => $field->id],
            ['valor' => $value]
        );
    }

    /**
     * Obtener todos los campos con sus valores como array asociativo
     */
    public function getAllFieldValues()
    {
        $result = [
            'id' => $this->id,
            'tipo' => $this->tipo,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
        ];

        foreach ($this->values as $value) {
            $result[$value->field->nombre_campo] = $value->valor;
        }

        return $result;
    }

    /**
     * Scope para buscar por tipo
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('tipo', $type);
    }

    /**
     * Scope para buscar por nombre
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nombre', 'like', "%{$search}%")
              ->orWhere('apellido', 'like', "%{$search}%");
        });
    }

    /**
     * Obtener nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return trim("{$this->nombre} {$this->apellido}");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Context extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'year',
        'tipo',
        'descripcion',
    ];

    /**
     * Relación con entidades
     */
    public function entities()
    {
        return $this->belongsToMany(Entity::class, 'entity_context')
            ->withPivot('rol')
            ->withTimestamps();
    }

    /**
     * Obtener entidades por rol
     */
    public function entitiesByRole($rol)
    {
        return $this->entities()->wherePivot('rol', $rol);
    }

    /**
     * Scope para buscar por tipo
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('tipo', $type);
    }

    /**
     * Scope para buscar por año
     */
    public function scopeOfYear($query, $year)
    {
        return $query->where('year', $year);
    }

    /**
     * Scope para búsqueda
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nombre', 'like', "%{$search}%");
    }
}

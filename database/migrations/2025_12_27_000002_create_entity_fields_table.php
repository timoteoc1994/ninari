<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entity_fields', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_campo')->unique();
            $table->string('etiqueta');
            $table->enum('tipo_dato', ['text', 'number', 'boolean', 'date', 'select'])->default('text');
            $table->json('opciones')->nullable(); // Para campos tipo select
            $table->boolean('es_requerido')->default(false);
            $table->integer('orden')->default(0); // Para ordenar los campos en formularios
            $table->timestamps();
            
            $table->index('nombre_campo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_fields');
    }
};

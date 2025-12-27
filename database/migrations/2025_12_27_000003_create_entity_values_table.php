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
        Schema::create('entity_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained('entities')->onDelete('cascade');
            $table->foreignId('field_id')->constrained('entity_fields')->onDelete('cascade');
            $table->text('valor')->nullable();
            $table->timestamps();
            
            // Un campo solo puede tener un valor por entidad
            $table->unique(['entity_id', 'field_id']);
            
            // Índices para búsquedas
            $table->index('entity_id');
            $table->index('field_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_values');
    }
};

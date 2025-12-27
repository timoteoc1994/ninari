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
        Schema::create('entity_context', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained('entities')->onDelete('cascade');
            $table->foreignId('context_id')->constrained('contexts')->onDelete('cascade');
            $table->enum('rol', ['participante', 'aliado', 'beneficiario', 'mentor'])->default('participante');
            $table->timestamps();
            
            // Una entidad puede estar en un contexto con un rol específico
            $table->unique(['entity_id', 'context_id']);
            
            $table->index('entity_id');
            $table->index('context_id');
            $table->index('rol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_context');
    }
};

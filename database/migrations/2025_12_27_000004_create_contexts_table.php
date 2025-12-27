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
        Schema::create('contexts', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('year')->nullable();
            $table->enum('tipo', ['proyecto', 'programa', 'convocatoria'])->default('proyecto');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            
            $table->index('tipo');
            $table->index('year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contexts');
    }
};

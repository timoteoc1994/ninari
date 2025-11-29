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
        Schema::create('certificate_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('certificate_batches')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('status')->default('pending'); // pending, sent, downloaded
            $table->uuid('token')->unique();
            $table->json('variable_data')->nullable();
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_recipients');
    }
};

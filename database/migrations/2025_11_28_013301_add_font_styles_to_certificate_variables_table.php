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
        Schema::table('certificate_variables', function (Blueprint $table) {
            $table->boolean('bold')->default(false)->after('font_size');
            $table->boolean('italic')->default(false)->after('bold');
            $table->boolean('underline')->default(false)->after('italic');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificate_variables', function (Blueprint $table) {
            $table->dropColumn(['bold', 'italic', 'underline']);
        });
    }
};

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
        Schema::create('akuntabilitas', function (Blueprint $table) {
            $table->id();
                       // Tahun laporan
            $table->year('tahun');

            // Judul dokumen
            $table->string('judul');

            // File PDF
            $table->string('pdf');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akuntabilitas');
    }
};

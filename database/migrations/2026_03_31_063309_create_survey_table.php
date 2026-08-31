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
        Schema::create('survey', function (Blueprint $table) {
            $table->id();

            // Judul survey
            $table->string('judul');

            // Isi (Summernote HTML)
            $table->longText('isi');

            // File laporan (PDF)
            $table->string('laporan')->nullable();

            // Kategori survey
            $table->enum('kategori', [
                'SKM', // Survey Kepuasan Masyarakat
                'SPAK' // Survey Persepsi Anti Korupsi
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey');
    }
};

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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();

            // Judul pengumuman
            $table->string('judul');

            $table->string('slug')->unique();

            // Isi pengumuman
            $table->text('isi');

            // Gambar (opsional)
            $table->string('gambar')->nullable();

            // File lampiran (PDF dll)
            $table->string('file')->nullable();

            // Status publish
            $table->enum('status', ['draft', 'published'])->default('draft');

            // Tanggal tampil
            $table->date('tanggal');

            // Waktu publish (opsional)
            $table->timestamp('published_at')->nullable();

            // Highlight / penting
            $table->boolean('is_penting')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};

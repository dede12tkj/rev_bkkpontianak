<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_informasi_publik_berkala', function (Blueprint $table) {
            $table->id();

            // relasi ke informasi publik berkala
            $table->foreignId('informasi_publik_berkala_id')
                  ->constrained('informasi_publik_berkala')
                  ->cascadeOnDelete();

            $table->string('judul');
            $table->longText('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_informasi_publik_berkala');
    }
};

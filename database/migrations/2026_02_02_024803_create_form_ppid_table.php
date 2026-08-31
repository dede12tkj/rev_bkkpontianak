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
        Schema::create('form_ppid', function (Blueprint $table) {
            $table->id();
            $table->string('form_permohonan_informasi')->nullable();
            $table->string('form_keberatan')->nullable();
            $table->string('file_daftar_informasi_publik')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_ppid');
    }
};

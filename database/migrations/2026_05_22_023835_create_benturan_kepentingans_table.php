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
        Schema::create('benturan_kepentingans', function (Blueprint $table) {

            $table->id();

            $table->string('nama_lengkap');

            $table->string('jabatan');

            $table->string('unit_kerja');

            $table->string('email');

            $table->text('uraian_konflik');

            $table->text('kepentingan');

            $table->text('penyebab');

            $table->string('tempat_laporan');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benturan_kepentingans');
    }
};

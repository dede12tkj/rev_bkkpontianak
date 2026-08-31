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
    Schema::create('sub_informasi_publik_setiap_saat', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('informasi_publik_setiap_saat_id');

$table->foreign('informasi_publik_setiap_saat_id', 'sub_ppid_foreign')
      ->references('id')
      ->on('informasi_publik_setiap_saat')
      ->onDelete('cascade');

        $table->string('judul');
        $table->longText('deskripsi');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_informasi_publik_setiap_saat');
    }
};

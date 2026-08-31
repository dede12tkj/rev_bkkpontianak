<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('layanan_pengaduan', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
        $table->integer('umur');
        $table->text('permasalahan');
        $table->enum('status_pengaduan', ['Menunggu', 'Diproses', 'Selesai'])
              ->default('Menunggu');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_pengaduan_table');
    }
};

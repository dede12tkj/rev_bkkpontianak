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
        Schema::create('sop', function (Blueprint $table) {
            $table->id();

            // Kategori proses
            $table->enum('kategori', [
                'proses1',
                'proses2',
                'proses3',
                'proses4',
                'proses5',
                'proses6',
            ]);

            // Judul SOP
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
        Schema::dropIfExists('sop');
    }
};

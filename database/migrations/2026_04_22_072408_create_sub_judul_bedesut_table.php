<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sub_judul_bedesut', function (Blueprint $table) {
            $table->id();

            $table->foreignId('judul_bedesut_id')
                  ->constrained('judul_bedesut')
                  ->cascadeOnDelete();

            $table->string('nama');

            // polymorphic relation
            $table->morphs('konten');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_judul_bedesut');
    }
};

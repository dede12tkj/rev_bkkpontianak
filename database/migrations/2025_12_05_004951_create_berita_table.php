<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('konten');
            $table->string('thumbnail')->nullable();

            $table->foreignId('kategori_id')
                ->nullable()
                ->constrained('kategori_berita')
                ->nullOnDelete();

            $table->foreignId('penulis_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('status', ['draft', 'published'])->default('draft');

            $table->integer('views')->default(0);

            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};

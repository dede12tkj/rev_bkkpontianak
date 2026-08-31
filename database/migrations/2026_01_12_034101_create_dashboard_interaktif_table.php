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
        Schema::create('dashboard_interaktif', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->longText('text');
            $table->string('link_looker')->nullable();
            $table->string('thumbnail')->nullable();
            $table->foreignId('bedesut_id')
                ->nullable()
                ->constrained('bedesut')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_interaktif');
    }
};

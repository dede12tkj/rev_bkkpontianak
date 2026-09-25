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
        Schema::create('skm_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skm_section_id')->constrained('skm_sections')->cascadeOnDelete();
            // Tipe pertanyaan: select, radio, checkbox, likert, text, textarea, number
            $table->string('type');
            $table->text('label');
            $table->longText('help_text')->nullable();
            // Konfigurasi fleksibel per tipe (skala likert, min/max, dsb)
            $table->json('config')->nullable();
            $table->boolean('is_required')->default(true);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skm_questions');
    }
};

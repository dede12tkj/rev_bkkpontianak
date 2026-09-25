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
        Schema::create('skm_question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skm_question_id')->constrained('skm_questions')->cascadeOnDelete();
            $table->string('label');
            $table->string('value');
            // Jika true, saat opsi ini dipilih akan muncul input teks bebas ("Other: ...")
            $table->boolean('allow_other')->default(false);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skm_question_options');
    }
};

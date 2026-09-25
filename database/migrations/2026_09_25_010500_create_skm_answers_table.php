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
        Schema::create('skm_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skm_response_id')->constrained('skm_responses')->cascadeOnDelete();
            // nullOnDelete supaya histori jawaban tetap ada walau pertanyaan dihapus
            $table->foreignId('skm_question_id')->nullable()
                ->constrained('skm_questions')->nullOnDelete();

            // Snapshot label pertanyaan saat disubmit, agar laporan lama tetap akurat
            // walau teks pertanyaan diubah admin di kemudian hari
            $table->text('question_label_snapshot')->nullable();

            $table->longText('value_text')->nullable();
            $table->decimal('value_number', 8, 2)->nullable();
            // Untuk jawaban checkbox (multi pilihan) atau data terstruktur lain
            $table->json('value_json')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skm_answers');
    }
};

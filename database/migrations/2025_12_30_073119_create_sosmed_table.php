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
        Schema::create('sosmed', function (Blueprint $table) {
            $table->id();
            $table->string('twitter');
            $table->string('fb');
            $table->string('wa');
            $table->string('ig');
            $table->string('yt');
            $table->string('tiktok');
            $table->string('maps');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sosmed');
    }
};

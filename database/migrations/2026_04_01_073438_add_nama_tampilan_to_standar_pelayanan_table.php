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
        Schema::table('standar_pelayanan', function (Blueprint $table) {
            $table->string('nama_tampilan')->nullable()->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('standar_pelayanan', function (Blueprint $table) {
            $table->dropColumn('nama_tampilan');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('carousel_table', 'subtitle')) {
            Schema::table('carousel_table', function (Blueprint $table) {
                $table->string('subtitle', 80)->nullable()->after('text');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('carousel_table', 'subtitle')) {
            Schema::table('carousel_table', function (Blueprint $table) {
                $table->dropColumn('subtitle');
            });
        }
    }
};

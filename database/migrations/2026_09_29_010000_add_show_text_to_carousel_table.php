<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('carousel_table', 'show_text')) {
            Schema::table('carousel_table', function (Blueprint $table) {
                $table->boolean('show_text')->default(true)->after('subtitle');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('carousel_table', 'show_text')) {
            Schema::table('carousel_table', function (Blueprint $table) {
                $table->dropColumn('show_text');
            });
        }
    }
};

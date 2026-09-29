<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Index untuk query yang jalan di halaman publik.
     * Setiap index dicek dulu, jadi aman dijalankan ulang.
     */
    public function up(): void
    {
        $this->addIndex('visitors', ['visit_date', 'ip_address'], 'visitors_visit_date_ip_idx');
        $this->addIndex('beritas', ['status', 'tanggal'], 'beritas_status_tanggal_idx');
        $this->addIndex('survey', ['kategori', 'created_at'], 'survey_kategori_created_idx');
    }

    public function down(): void
    {
        $this->dropIndex('visitors', 'visitors_visit_date_ip_idx');
        $this->dropIndex('beritas', 'beritas_status_tanggal_idx');
        $this->dropIndex('survey', 'survey_kategori_created_idx');
    }

    private function addIndex(string $table, array $columns, string $name): void
    {
        if (! Schema::hasTable($table) || Schema::hasIndex($table, $name)) {
            return;
        }

        foreach ($columns as $column) {
            if (! Schema::hasColumn($table, $column)) {
                return;
            }
        }

        Schema::table($table, function (Blueprint $t) use ($columns, $name) {
            $t->index($columns, $name);
        });
    }

    private function dropIndex(string $table, string $name): void
    {
        if (Schema::hasTable($table) && Schema::hasIndex($table, $name)) {
            Schema::table($table, function (Blueprint $t) use ($name) {
                $t->dropIndex($name);
            });
        }
    }
};

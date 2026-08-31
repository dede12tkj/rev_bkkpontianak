<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardInteraktif extends Model
{
    protected $table = 'dashboard_interaktif';

    protected $fillable = [
        'judul',
        'link_looker'
    ];

    /**
     * 🔹 Relasi ke SubJudul (polymorphic)
     */
    public function subJudul()
    {
        return $this->morphOne(SubJudulBedesut::class, 'konten');
    }
}

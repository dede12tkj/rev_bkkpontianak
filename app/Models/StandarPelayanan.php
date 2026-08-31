<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandarPelayanan extends Model
{
    use HasFactory;

    protected $table = 'standar_pelayanan';

    protected $fillable = [
        'nama',
        'nama_tampilan',
        'text',
    ];

    public function getIconAttribute()
    {
        $icons = [
            1 => 'fa fa-syringe',
            2 => 'fa fa-plane-departure',
            3 => 'fa fa-notes-medical',
            4 => 'fa fa-ship',
            5 => 'fa fa-file-signature',
            6 => 'fa fa-book-medical',
            7 => 'fa fa-medkit',
            8 => 'fa fa-ambulance',
            9 => 'fa fa-plus-square',
            10 => 'fa fa-road',
            11 => 'fa fa-utensils',
            12 => 'fa fa-industry',
            13 => 'fa fa-boxes',
            14 => 'fa fa-tint',
            15 => 'fa fa-id-card',
        ];

        return $icons[$this->id] ?? 'fa fa-cogs';
    }
}

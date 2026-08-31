<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegulasiSopKI extends Model
{
    protected $table = 'sop_ki_ppid';

    protected $fillable = [
        'nama',
        'path'
    ];
}

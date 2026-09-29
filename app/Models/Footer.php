<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use \App\Models\Concerns\FlushesHomeCache;

    use HasFactory;
    protected $table = 'footer';
    protected $fillable = [
                'text',
        'alamat',
        'email',
        'no_telp',
        'lokasi',
    ];
}

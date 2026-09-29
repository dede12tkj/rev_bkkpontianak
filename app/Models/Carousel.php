<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use \App\Models\Concerns\FlushesHomeCache;

    use HasFactory;
    protected $table = 'carousel_table';
    protected $fillable = [
        'path',
        'text',
    ];
}

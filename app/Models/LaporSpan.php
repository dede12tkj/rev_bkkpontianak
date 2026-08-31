<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporSpan extends Model
{
    use HasFactory;
    protected $table = 'lapor_span';
    protected $fillable = [
        'text'
    ];
}

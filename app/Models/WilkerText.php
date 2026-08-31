<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilkerText extends Model
{
    use HasFactory;
    protected $table = 'wilker_text';
    protected $fillable = [
        'text'
    ];
}

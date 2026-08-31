<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakKami extends Model
{
  protected $table = 'kontak_kamis';

  protected $fillable = [
    'nama',
    'email',
    'pesan'
  ];
}

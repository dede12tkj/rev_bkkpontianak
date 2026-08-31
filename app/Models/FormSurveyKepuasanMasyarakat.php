<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSurveyKepuasanMasyarakat extends Model
{
    use HasFactory;
    protected $table = 'form_survey_kepuasan_masyarakat';
    protected $fillable = [
        'text',
        'link',
    ];
}

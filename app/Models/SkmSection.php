<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkmSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'skm_survey_id',
        'title',
        'description',
        'order',
    ];

    public function survey()
    {
        return $this->belongsTo(SkmSurvey::class, 'skm_survey_id');
    }

    public function questions()
    {
        return $this->hasMany(SkmQuestion::class)->orderBy('order');
    }
}

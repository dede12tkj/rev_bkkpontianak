<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkmResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'skm_survey_id',
        'ip_address',
        'user_agent',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function survey()
    {
        return $this->belongsTo(SkmSurvey::class, 'skm_survey_id');
    }

    public function answers()
    {
        return $this->hasMany(SkmAnswer::class);
    }
}

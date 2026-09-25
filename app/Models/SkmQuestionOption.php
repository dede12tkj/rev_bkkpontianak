<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkmQuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'skm_question_id',
        'label',
        'value',
        'allow_other',
        'order',
    ];

    protected $casts = [
        'allow_other' => 'boolean',
    ];

    public function question()
    {
        return $this->belongsTo(SkmQuestion::class, 'skm_question_id');
    }
}

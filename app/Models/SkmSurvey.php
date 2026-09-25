<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkmSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function sections()
    {
        return $this->hasMany(SkmSection::class)->orderBy('order');
    }

    public function responses()
    {
        return $this->hasMany(SkmResponse::class);
    }

    /**
     * Semua pertanyaan dalam survey ini (lintas section), urut sesuai section & urutan.
     */
    public function questions()
    {
        return $this->hasManyThrough(
            SkmQuestion::class,
            SkmSection::class,
            'skm_survey_id',
            'skm_section_id'
        )->orderBy('skm_sections.order')->orderBy('skm_questions.order');
    }
}

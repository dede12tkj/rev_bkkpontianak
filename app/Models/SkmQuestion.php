<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkmQuestion extends Model
{
    use HasFactory;

    // Daftar tipe pertanyaan yang didukung sistem.
    // Menambah tipe baru di sini + partial view-nya = tanpa perlu migration baru,
    // karena konfigurasi per tipe disimpan fleksibel di kolom `config` (JSON).
    public const TYPES = [
        'select'   => 'Dropdown (Pilih Satu)',
        'radio'    => 'Pilihan Ganda (Radio)',
        'checkbox' => 'Kotak Centang (Multi Pilihan)',
        'likert'   => 'Skala Likert',
        'text'     => 'Isian Singkat',
        'textarea' => 'Isian Panjang',
        'number'   => 'Angka',
    ];

    // Tipe yang membutuhkan daftar opsi (skm_question_options)
    public const CHOICE_TYPES = ['select', 'radio', 'checkbox'];

    protected $fillable = [
        'skm_section_id',
        'type',
        'label',
        'help_text',
        'config',
        'is_required',
        'order',
    ];

    protected $casts = [
        'config'      => 'array',
        'is_required' => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(SkmSection::class, 'skm_section_id');
    }

    public function options()
    {
        return $this->hasMany(SkmQuestionOption::class)->orderBy('order');
    }

    public function answers()
    {
        return $this->hasMany(SkmAnswer::class);
    }

    public function isChoiceType(): bool
    {
        return in_array($this->type, self::CHOICE_TYPES);
    }

    public function isLikert(): bool
    {
        return $this->type === 'likert';
    }

    public function scaleMin()
    {
        return $this->config['scale_min'] ?? 1;
    }

    public function scaleMax()
    {
        return $this->config['scale_max'] ?? 4;
    }

    public function scaleMinLabel()
    {
        return $this->config['min_label'] ?? '';
    }

    public function scaleMaxLabel()
    {
        return $this->config['max_label'] ?? '';
    }
}

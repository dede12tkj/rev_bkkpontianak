<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkmAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'skm_response_id',
        'skm_question_id',
        'question_label_snapshot',
        'value_text',
        'value_number',
        'value_json',
    ];

    protected $casts = [
        'value_json'   => 'array',
        'value_number' => 'decimal:2',
    ];

    public function response()
    {
        return $this->belongsTo(SkmResponse::class, 'skm_response_id');
    }

    public function question()
    {
        return $this->belongsTo(SkmQuestion::class, 'skm_question_id');
    }

    /**
     * Tampilkan nilai jawaban apa adanya, tidak peduli disimpan di kolom mana.
     */
    public function getDisplayValueAttribute()
    {
        if (!is_null($this->value_number)) {
            return (string) (float) $this->value_number;
        }

        if (!is_null($this->value_json)) {
            return implode(', ', (array) $this->value_json);
        }

        return $this->value_text;
    }
}

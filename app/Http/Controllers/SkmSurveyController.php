<?php

namespace App\Http\Controllers;

use App\Models\SkmAnswer;
use App\Models\SkmQuestion;
use App\Models\SkmResponse;
use App\Models\SkmSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class SkmSurveyController extends Controller
{
    // Maksimal pengisian per IP dalam satu jendela waktu, sebelum diblokir sementara
    private const MAX_ATTEMPTS = 3;

    // Panjang jendela waktu rate limit, dalam menit
    private const DECAY_MINUTES = 60;

    /**
     * Tampilkan form survey (publik).
     */
    public function show()
    {
        $survey = SkmSurvey::where('is_active', true)
            ->with(['sections.questions.options'])
            ->latest()
            ->firstOrFail();

        return view('pages.frontend.skm-survey.show', compact('survey'));
    }

    /**
     * Simpan jawaban survey (publik).
     */
    public function store(Request $request, SkmSurvey $skmSurvey)
    {
        $rateLimitKey = 'skm-survey-submit:' . $request->ip();

        // 1) Cegah pengisian bertubi-tubi dari IP yang sama
        if (RateLimiter::tooManyAttempts($rateLimitKey, self::MAX_ATTEMPTS)) {
            $minutes = max(1, (int) ceil(RateLimiter::availableIn($rateLimitKey) / 60));

            return back()
                ->withInput()
                ->with('error', "Anda sudah mengisi survei ini beberapa kali dalam waktu singkat. "
                    . "Silakan coba lagi dalam {$minutes} menit.");
        }

        // 2) Honeypot: field tersembunyi yang hanya akan terisi oleh bot.
        // Pengguna manusia tidak pernah melihat/mengisi field ini.
        if (trim((string) $request->input('website', '')) !== '') {
            // Berpura-pura berhasil supaya bot tidak tahu bahwa ia terdeteksi,
            // tapi tidak benar-benar menyimpan apapun ke database.
            return redirect()
                ->route('skm-survey.show')
                ->with('success', 'Terima kasih, jawaban survei Anda berhasil kami terima.');
        }

        $questions = SkmQuestion::whereHas('section', function ($q) use ($skmSurvey) {
            $q->where('skm_survey_id', $skmSurvey->id);
        })->with('options')->get();

        $rules = [];
        $attributes = [];

        foreach ($questions as $question) {
            $field = "answers.{$question->id}";
            $attributes[$field] = $question->label;

            $required = $question->is_required ? 'required' : 'nullable';

            switch ($question->type) {
                case 'select':
                case 'radio':
                    $allowed = $question->options->pluck('value')->push('__other__')->all();
                    $rules[$field] = [$required, 'in:' . implode(',', $allowed)];
                    break;

                case 'checkbox':
                    $rules[$field] = [$required, 'array'];
                    $allowed = $question->options->pluck('value')->all();
                    $rules["{$field}.*"] = ['in:' . implode(',', $allowed)];
                    break;

                case 'likert':
                    $rules[$field] = [
                        $required,
                        'integer',
                        'between:' . $question->scaleMin() . ',' . $question->scaleMax(),
                    ];
                    break;

                case 'number':
                    $numberRules = [$required, 'numeric'];
                    if (isset($question->config['min'])) {
                        $numberRules[] = 'min:' . $question->config['min'];
                    }
                    if (isset($question->config['max'])) {
                        $numberRules[] = 'max:' . $question->config['max'];
                    }
                    $rules[$field] = $numberRules;
                    break;

                case 'textarea':
                case 'text':
                default:
                    $textRules = [$required, 'string', 'max:' . ($question->config['max_length'] ?? 2000)];
                    $rules[$field] = $textRules;
                    break;
            }

            // Validasi input "Other" jika pertanyaan ini punya opsi allow_other
            if ($question->options->contains('allow_other', true)) {
                $rules["answers_other.{$question->id}"] = 'nullable|string|max:255|required_if:' . $field . ',__other__';
            }
        }

        $validator = Validator::make($request->all(), $rules, [], $attributes);
        $validator->validate();

        DB::transaction(function () use ($request, $skmSurvey, $questions) {
            $response = SkmResponse::create([
                'skm_survey_id' => $skmSurvey->id,
                'ip_address'    => $request->ip(),
                'user_agent'    => substr((string) $request->userAgent(), 0, 255),
                'submitted_at'  => now(),
            ]);

            $answers = $request->input('answers', []);
            $othersInput = $request->input('answers_other', []);

            foreach ($questions as $question) {
                if (!array_key_exists($question->id, $answers)) {
                    continue;
                }

                $value = $answers[$question->id];

                $payload = [
                    'skm_response_id'         => $response->id,
                    'skm_question_id'         => $question->id,
                    'question_label_snapshot' => $question->label,
                ];

                switch ($question->type) {
                    case 'checkbox':
                        $payload['value_json'] = array_values((array) $value);
                        break;

                    case 'likert':
                    case 'number':
                        $payload['value_number'] = $value;
                        break;

                    case 'select':
                    case 'radio':
                        if ($value === '__other__') {
                            $payload['value_text'] = trim((string) ($othersInput[$question->id] ?? ''));
                        } else {
                            $payload['value_text'] = $value;
                        }
                        break;

                    default:
                        $payload['value_text'] = $value;
                        break;
                }

                SkmAnswer::create($payload);
            }
        });

        // 3) Baru hitung jatah rate limit SETELAH submit benar-benar berhasil,
        // supaya orang yang salah isi form (validasi gagal) tidak dirugikan jatahnya.
        RateLimiter::hit($rateLimitKey, self::DECAY_MINUTES * 60);

        return redirect()
            ->route('skm-survey.show')
            ->with('success', 'Terima kasih, jawaban survei Anda berhasil kami terima.');
    }
}

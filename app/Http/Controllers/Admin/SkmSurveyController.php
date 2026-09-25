<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkmAnswer;
use App\Models\SkmQuestion;
use App\Models\SkmResponse;
use App\Models\SkmSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkmSurveyController extends Controller
{
    /**
     * Halaman builder: kelola section, pertanyaan, dan opsi.
     */
    public function index()
    {
        $survey = SkmSurvey::with(['sections.questions.options'])
            ->latest()
            ->first();

        return view('pages.backend.skm-survey.index', compact('survey'));
    }

    /**
     * Buat survey baru (jika belum ada sama sekali).
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        SkmSurvey::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title) . '-' . Str::random(5),
            'description' => $request->description,
            'is_active'   => true,
        ]);

        return back()->with('success', 'Survei berhasil dibuat.');
    }

    /**
     * Update judul/deskripsi/status aktif survey.
     */
    public function update(Request $request, SkmSurvey $skmSurvey)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $skmSurvey->update([
            'title'       => $request->title,
            'description' => $request->description,
            'is_active'   => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Pengaturan survei berhasil diperbarui.');
    }

    /**
     * Halaman rekap hasil survei: rata-rata skor tiap unsur + daftar responden.
     */
    public function responses(Request $request)
    {
        $survey = SkmSurvey::with(['sections.questions'])->latest()->first();

        $recap = [];

        if ($survey) {
            foreach ($survey->sections as $section) {
                $likertQuestions = $section->questions->where('type', 'likert');

                if ($likertQuestions->isEmpty()) {
                    continue;
                }

                $items = [];
                $scaleMax = $likertQuestions->first()->scaleMax();

                foreach ($likertQuestions as $question) {
                    $avg = SkmAnswer::where('skm_question_id', $question->id)
                        ->whereNotNull('value_number')
                        ->avg('value_number');

                    $items[] = [
                        'label' => $question->label,
                        'avg'   => $avg ? round($avg, 2) : null,
                        'count' => SkmAnswer::where('skm_question_id', $question->id)
                            ->whereNotNull('value_number')->count(),
                    ];
                }

                $validAverages = collect($items)->pluck('avg')->filter(fn ($v) => !is_null($v));
                $overallAvg = $validAverages->isNotEmpty() ? $validAverages->avg() : null;
                $index = $overallAvg ? round($overallAvg * (100 / $scaleMax), 2) : null;

                $recap[] = [
                    'section'    => $section->title,
                    'scale_max'  => $scaleMax,
                    'items'      => $items,
                    'overall_avg' => $overallAvg ? round($overallAvg, 2) : null,
                    'index'      => $index,
                ];
            }
        }

        $responses = $survey
            ? SkmResponse::where('skm_survey_id', $survey->id)->latest()->paginate(20)
            : collect();

        $totalResponses = $survey
            ? SkmResponse::where('skm_survey_id', $survey->id)->count()
            : 0;

        return view('pages.backend.skm-survey.responses', compact(
            'survey',
            'recap',
            'responses',
            'totalResponses'
        ));
    }

    /**
     * Detail satu response (semua jawaban).
     */
    public function showResponse(SkmResponse $skmResponse)
    {
        $skmResponse->load('answers.question.section');

        $grouped = $skmResponse->answers->groupBy(fn ($answer) => optional($answer->question?->section)->title ?? 'Lainnya');

        return view('pages.backend.skm-survey.response-show', [
            'response' => $skmResponse,
            'grouped'  => $grouped,
        ]);
    }

    /**
     * Hapus satu response.
     */
    public function destroyResponse(SkmResponse $skmResponse)
    {
        $skmResponse->delete();

        return back()->with('success', 'Data response berhasil dihapus.');
    }

    /**
     * Export seluruh response ke CSV.
     */
    public function exportResponses(SkmSurvey $skmSurvey)
    {
        $questions = SkmQuestion::whereHas('section', function ($q) use ($skmSurvey) {
            $q->where('skm_survey_id', $skmSurvey->id);
        })->orderBy('skm_section_id')->orderBy('order')->get();

        $responses = SkmResponse::where('skm_survey_id', $skmSurvey->id)
            ->with('answers')
            ->orderBy('submitted_at')
            ->get();

        $filename = 'rekap-survei-ikm-' . now()->format('Y-m-d-His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($questions, $responses) {
            $handle = fopen('php://output', 'w');
            // BOM agar Excel membaca UTF-8 dengan benar
            fwrite($handle, "\xEF\xBB\xBF");

            $header = ['Tanggal Submit', 'IP Address'];
            foreach ($questions as $q) {
                $header[] = $q->label;
            }
            fputcsv($handle, $header);

            foreach ($responses as $response) {
                $row = [
                    optional($response->submitted_at)->format('Y-m-d H:i'),
                    $response->ip_address,
                ];

                foreach ($questions as $q) {
                    $answer = $response->answers->firstWhere('skm_question_id', $q->id);
                    $row[] = $answer ? $answer->display_value : '';
                }

                fputcsv($handle, $row);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}

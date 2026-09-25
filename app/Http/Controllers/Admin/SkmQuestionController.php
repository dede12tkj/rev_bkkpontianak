<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkmQuestion;
use App\Models\SkmQuestionOption;
use App\Models\SkmSection;
use Illuminate\Http\Request;

class SkmQuestionController extends Controller
{
    public function store(Request $request, SkmSection $skmSection)
    {
        $data = $this->validated($request);

        $maxOrder = $skmSection->questions()->max('order');

        $question = $skmSection->questions()->create([
            'type'        => $data['type'],
            'label'       => $data['label'],
            'help_text'   => $data['help_text'] ?? null,
            'config'      => $this->buildConfig($data),
            'is_required' => $data['is_required'] ?? false,
            'order'       => ($maxOrder ?? 0) + 1,
        ]);

        $this->syncOptions($question, $data);

        return back()->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function update(Request $request, SkmQuestion $skmQuestion)
    {
        $data = $this->validated($request);

        $skmQuestion->update([
            'type'        => $data['type'],
            'label'       => $data['label'],
            'help_text'   => $data['help_text'] ?? null,
            'config'      => $this->buildConfig($data),
            'is_required' => $data['is_required'] ?? false,
        ]);

        $this->syncOptions($skmQuestion, $data);

        return back()->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroy(SkmQuestion $skmQuestion)
    {
        $skmQuestion->delete();

        return back()->with('success', 'Pertanyaan berhasil dihapus.');
    }

    /**
     * Geser urutan pertanyaan naik/turun dalam satu section.
     */
    public function move(Request $request, SkmQuestion $skmQuestion)
    {
        $direction = $request->input('direction');

        $sibling = SkmQuestion::where('skm_section_id', $skmQuestion->skm_section_id)
            ->when($direction === 'up', fn ($q) => $q->where('order', '<', $skmQuestion->order)->orderByDesc('order'))
            ->when($direction === 'down', fn ($q) => $q->where('order', '>', $skmQuestion->order)->orderBy('order'))
            ->first();

        if ($sibling) {
            $tmp = $skmQuestion->order;
            $skmQuestion->update(['order' => $sibling->order]);
            $sibling->update(['order' => $tmp]);
        }

        return back();
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'type'                 => 'required|in:' . implode(',', array_keys(SkmQuestion::TYPES)),
            'label'                => 'required|string',
            'help_text'            => 'nullable|string',
            'is_required'          => 'nullable|boolean',
            'option_label'         => 'nullable|array',
            'option_label.*'       => 'nullable|string|max:255',
            'option_allow_other'   => 'nullable|array',
            'scale_min'            => 'nullable|integer',
            'scale_max'            => 'nullable|integer|gte:scale_min',
            'min_label'            => 'nullable|string|max:100',
            'max_label'            => 'nullable|string|max:100',
            'max_length'           => 'nullable|integer|min:1',
            'min_value'            => 'nullable|numeric',
            'max_value'            => 'nullable|numeric',
        ]);
    }

    /**
     * Susun kolom `config` (JSON) sesuai tipe pertanyaan yang dipilih.
     * Inilah inti fleksibilitas sistem - tipe baru cukup tambah case di sini
     * dan partial view-nya, tanpa migration baru.
     */
    private function buildConfig(array $data): ?array
    {
        switch ($data['type']) {
            case 'likert':
                return [
                    'scale_min' => (int) ($data['scale_min'] ?? 1),
                    'scale_max' => (int) ($data['scale_max'] ?? 4),
                    'min_label' => $data['min_label'] ?? '',
                    'max_label' => $data['max_label'] ?? '',
                ];

            case 'text':
            case 'textarea':
                return $data['max_length'] ? ['max_length' => (int) $data['max_length']] : null;

            case 'number':
                $config = [];
                if (isset($data['min_value']) && $data['min_value'] !== '') {
                    $config['min'] = (float) $data['min_value'];
                }
                if (isset($data['max_value']) && $data['max_value'] !== '') {
                    $config['max'] = (float) $data['max_value'];
                }
                return $config ?: null;

            default:
                return null;
        }
    }

    /**
     * Hapus opsi lama lalu buat ulang sesuai input form (pendekatan paling
     * sederhana & tahan-error untuk builder dinamis seperti ini).
     */
    private function syncOptions(SkmQuestion $question, array $data): void
    {
        if (!$question->isChoiceType()) {
            $question->options()->delete();
            return;
        }

        $question->options()->delete();

        $labels = $data['option_label'] ?? [];
        $allowOther = $data['option_allow_other'] ?? [];

        $order = 1;
        foreach ($labels as $key => $label) {
            $label = trim((string) $label);
            if ($label === '') {
                continue;
            }

            SkmQuestionOption::create([
                'skm_question_id' => $question->id,
                'label'           => $label,
                'value'           => $label,
                'allow_other'     => isset($allowOther[$key]),
                'order'           => $order++,
            ]);
        }
    }
}

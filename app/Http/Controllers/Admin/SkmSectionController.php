<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkmSection;
use App\Models\SkmSurvey;
use Illuminate\Http\Request;

class SkmSectionController extends Controller
{
    public function store(Request $request, SkmSurvey $skmSurvey)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $maxOrder = $skmSurvey->sections()->max('order');

        $skmSurvey->sections()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'order'       => ($maxOrder ?? 0) + 1,
        ]);

        return back()->with('success', 'Bagian (section) berhasil ditambahkan.');
    }

    public function update(Request $request, SkmSection $skmSection)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $skmSection->update($request->only('title', 'description'));

        return back()->with('success', 'Bagian (section) berhasil diperbarui.');
    }

    public function destroy(SkmSection $skmSection)
    {
        $skmSection->delete();

        return back()->with('success', 'Bagian (section) beserta seluruh pertanyaannya berhasil dihapus.');
    }

    /**
     * Geser urutan section naik/turun.
     */
    public function move(Request $request, SkmSection $skmSection)
    {
        $direction = $request->input('direction');

        $sibling = SkmSection::where('skm_survey_id', $skmSection->skm_survey_id)
            ->when($direction === 'up', fn ($q) => $q->where('order', '<', $skmSection->order)->orderByDesc('order'))
            ->when($direction === 'down', fn ($q) => $q->where('order', '>', $skmSection->order)->orderBy('order'))
            ->first();

        if ($sibling) {
            $tmp = $skmSection->order;
            $skmSection->update(['order' => $sibling->order]);
            $sibling->update(['order' => $tmp]);
        }

        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormSurveyKepuasanMasyarakat;

class FormSurveyKepuasanMasyarakatController extends Controller
{
    public function index()
    {
        $data = FormSurveyKepuasanMasyarakat::all();
        return view('pages.backend.form-survey-kepuasan-masyarakat.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'link' => 'nullable|url'
        ]);

        FormSurveyKepuasanMasyarakat::create([
            'text' => $request->text,
            'link' => $request->link,
        ]);

        return back()->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
            'link' => 'nullable|url'
        ]);

        $data = FormSurveyKepuasanMasyarakat::findOrFail($id);

        $data->update([
            'text' => $request->text,
            'link' => $request->link,
        ]);

        return back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        FormSurveyKepuasanMasyarakat::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}

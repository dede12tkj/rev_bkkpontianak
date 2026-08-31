<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bedesut;
use App\Models\DashboardInteraktif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BedesutDashboardController extends Controller
{
    public function index()
    {
        $data = DashboardInteraktif::with('bedesut')->latest()->get();
        $bedesut = Bedesut::all();

        return view('pages.backend.informasi-publik.bedesut-dashboard.index', compact('data', 'bedesut'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'text' => 'required',
            'link_looker' => 'nullable|url',
            'thumbnail' => 'nullable|image',
            'bedesut_id' => 'nullable|exists:bedesut,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('dashboard_interaktif', 'public');
        }

        DashboardInteraktif::create($data);

        return redirect()->route('admin-dashboard-interaktif.index')
            ->with('success', 'Dashboard Interaktif berhasil ditambahkan');
    }

    public function show($id)
    {
        $dashboard = DashboardInteraktif::with('bedesut')->findOrFail($id);

        return view('pages.frontend.informasi-publik.bedesut-dashboard-show', compact('dashboard'));
    }

    public function destroy($id)
    {
        $item = DashboardInteraktif::findOrFail($id);

        if ($item->thumbnail) {
            Storage::disk('public')->delete($item->thumbnail);
        }

        $item->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('file')->store('summernote', 'public');

        return response()->json([
            'url' => asset('storage/'.$path),
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = DashboardInteraktif::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'bedesut_id' => 'nullable|exists:bedesut,id',
            'link_looker' => 'nullable',
            'text' => 'required',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('dashboard-interaktif', 'public');
        }

        $item->update($data);

        return back()->with('success', 'Data berhasil diperbarui');
    }
}

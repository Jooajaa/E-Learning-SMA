<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::latest()->get();

        return view('guru.materi.index', compact('materi'));
    }

    public function create()
    {
        return view('guru.materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx'
        ]);

        $file = $request->file('file')
            ->store('materi', 'public');

        Materi::create([
            'guru_id' => auth()->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $file,
        ]);

        return redirect()
            ->route('guru.materi.index')
            ->with('success', 'Materi berhasil ditambahkan');
    }

    public function show($id)
    {
        $materi = Materi::findOrFail($id);

        return view('guru.materi.show', compact('materi'));
    }

    public function edit($id)
    {
        $materi = Materi::findOrFail($id);

        return view('guru.materi.edit', compact('materi'));
    }

    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        if ($request->hasFile('file')) {

            Storage::disk('public')
                ->delete($materi->file);

            $file = $request->file('file')
                ->store('materi', 'public');

            $materi->file = $file;
        }

        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;

        $materi->save();

        return redirect()
            ->route('guru.materi.index')
            ->with('success', 'Materi berhasil diupdate');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        Storage::disk('public')
            ->delete($materi->file);

        $materi->delete();

        return back()
            ->with('success', 'Materi berhasil dihapus');
    }
}
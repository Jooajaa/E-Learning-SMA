<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::latest()->get();

        return view('guru.tugas.index', compact('tugas'));
    }

    public function create()
    {
        return view('guru.tugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'instruksi' => 'required',
            'deadline' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,zip',
        ]);

        $file = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file')
                ->store('tugas', 'public');
        }

        Tugas::create([
            'guru_id' => auth()->id(),
            'judul' => $request->judul,
            'instruksi' => $request->instruksi,
            'deadline' => $request->deadline,
            'file' => $file,
        ]);

        return redirect()
            ->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil dibuat');
    }

    public function show(Tugas $tuga)
    {
        return view('guru.tugas.show', [
            'tugas' => $tuga
        ]);
    }

    public function edit(Tugas $tuga)
    {
        return view('guru.tugas.edit', [
            'tugas' => $tuga
        ]);
    }

    public function update(Request $request, Tugas $tuga)
    {
        $request->validate([
            'judul' => 'required',
            'instruksi' => 'required',
            'deadline' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,zip',
        ]);

        $data = [
            'judul' => $request->judul,
            'instruksi' => $request->instruksi,
            'deadline' => $request->deadline,
        ];

        if ($request->hasFile('file')) {

            if ($tuga->file) {
                Storage::disk('public')->delete($tuga->file);
            }

            $data['file'] = $request
                ->file('file')
                ->store('tugas', 'public');
        }

        $tuga->update($data);

        return redirect()
            ->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil diupdate');
    }

    public function destroy(Tugas $tuga)
    {
        if ($tuga->file) {
            Storage::disk('public')->delete($tuga->file);
        }

        $tuga->delete();

        return redirect()
            ->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil dihapus');
    }
}

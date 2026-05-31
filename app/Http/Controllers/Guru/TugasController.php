<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'instruksi' => 'nullable|string',
            'deadline' => 'nullable|date',
            'file' => 'nullable|file|max:5120',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tugas', 'public');
        }

        Tugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi ?? $request->instruksi,
            'instruksi' => $request->instruksi ?? $request->deskripsi,
            'deadline' => $request->deadline,
            'file' => $filePath,
            'guru_id' => Auth::id(),
        ]);

        return redirect()
            ->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);

        return view('guru.tugas.show', compact('tugas'));
    }

    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);

        return view('guru.tugas.edit', compact('tugas'));
    }

    public function update(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'instruksi' => 'nullable|string',
            'deadline' => 'nullable|date',
            'file' => 'nullable|file|max:5120',
        ]);

        $filePath = $tugas->file;

        if ($request->hasFile('file')) {
            if ($tugas->file && Storage::disk('public')->exists($tugas->file)) {
                Storage::disk('public')->delete($tugas->file);
            }

            $filePath = $request->file('file')->store('tugas', 'public');
        }

        $tugas->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi ?? $request->instruksi,
            'instruksi' => $request->instruksi ?? $request->deskripsi,
            'deadline' => $request->deadline,
            'file' => $filePath,
        ]);

        return redirect()
            ->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);

        if ($tugas->file && Storage::disk('public')->exists($tugas->file)) {
            Storage::disk('public')->delete($tugas->file);
        }

        $tugas->delete();

        return redirect()
            ->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }
}
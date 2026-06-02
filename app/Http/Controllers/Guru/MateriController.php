<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\GuruKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::with('kelas')
            ->where('guru_id', Auth::id())
            ->latest()
            ->get();

        return view('guru.materi.index', compact('materi'));
    }

    public function create()
    {
        $guruKelas = GuruKelas::with('kelas')
            ->where('guru_id', Auth::id())
            ->get();

        $kelas = $guruKelas->pluck('kelas')->filter();

        return view('guru.materi.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:5120',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materi', 'public');
        }

        Materi::create([
            'guru_id' => Auth::id(),
            'kelas_id' => $request->kelas_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
            'is_active' => true,
        ]);

        return redirect()
            ->route('guru.materi.index')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(Materi $materi)
    {
        return view('guru.materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        $guruKelas = GuruKelas::with('kelas')
            ->where('guru_id', Auth::id())
            ->get();

        $kelas = $guruKelas->pluck('kelas')->filter();

        return view('guru.materi.edit', compact('materi', 'kelas'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:5120',
        ]);

        $filePath = $materi->file;

        if ($request->hasFile('file')) {
            if ($materi->file && Storage::disk('public')->exists($materi->file)) {
                Storage::disk('public')->delete($materi->file);
            }

            $filePath = $request->file('file')->store('materi', 'public');
        }

        $materi->update([
            'kelas_id' => $request->kelas_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
        ]);

        return redirect()
            ->route('guru.materi.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->file && Storage::disk('public')->exists($materi->file)) {
            Storage::disk('public')->delete($materi->file);
        }

        $materi->delete();

        return redirect()
            ->route('guru.materi.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\GuruKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::with(['kelas', 'pengumpulan'])
            ->where('guru_id', Auth::id())
            ->latest()
            ->get();

        return view('guru.tugas.index', compact('tugas'));
    }

    public function create()
    {
        $guruKelas = GuruKelas::with('kelas')
            ->where('guru_id', Auth::id())
            ->get();

        $kelas = $guruKelas->pluck('kelas')->filter();

        return view('guru.tugas.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'instruksi' => 'nullable|string',
            'deadline' => 'required|date',
            'file' => 'nullable|file|max:5120',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tugas', 'public');
        }

        Tugas::create([
            'guru_id' => Auth::id(),
            'kelas_id' => $request->kelas_id,
            'judul' => $request->judul,
            'instruksi' => $request->instruksi ?? '-',
            'deadline' => $request->deadline,
            'file' => $filePath,
        ]);

        return redirect()
            ->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show(Tugas $tugas)
    {
        if ($tugas->guru_id != Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses ke tugas ini.');
        }

        $tugas->load(['kelas', 'pengumpulan.siswa']);

        return view('guru.tugas.show', compact('tugas'));
    }

    public function edit(Tugas $tugas)
    {
        if ($tugas->guru_id != Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses untuk mengedit tugas ini.');
        }

        $guruKelas = GuruKelas::with('kelas')
            ->where('guru_id', Auth::id())
            ->get();

        $kelas = $guruKelas->pluck('kelas')->filter();

        return view('guru.tugas.edit', compact('tugas', 'kelas'));
    }

    public function update(Request $request, Tugas $tugas)
    {
        if ($tugas->guru_id != Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses untuk mengubah tugas ini.');
        }

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'instruksi' => 'nullable|string',
            'deadline' => 'required|date',
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
            'kelas_id' => $request->kelas_id,
            'judul' => $request->judul,
            'instruksi' => $request->instruksi ?? '-',
            'deadline' => $request->deadline,
            'file' => $filePath,
        ]);

        return redirect()
            ->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Tugas $tugas)
    {
        if ($tugas->guru_id != Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses untuk menghapus tugas ini.');
        }

        if ($tugas->file && Storage::disk('public')->exists($tugas->file)) {
            Storage::disk('public')->delete($tugas->file);
        }

        $tugas->delete();

        return redirect()
            ->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }
}
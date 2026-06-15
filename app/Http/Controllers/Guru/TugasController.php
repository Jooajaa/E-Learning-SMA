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
        $tugas = Tugas::with(['kelas', 'mataPelajaran', 'pengumpulan'])
            ->where('guru_id', Auth::id())
            ->latest()
            ->get();

        return view('guru.tugas.index', compact('tugas'));
    }

    public function create(Request $request)
    {
        $guruKelasTerpilih = null;

        if ($request->has('guru_kelas_id')) {
            $guruKelasTerpilih = GuruKelas::with(['kelas', 'mataPelajaran'])
                ->where('guru_id', Auth::id())
                ->where('id', $request->guru_kelas_id)
                ->firstOrFail();
        }

        $guruKelas = GuruKelas::with(['kelas', 'mataPelajaran'])
            ->where('guru_id', Auth::id())
            ->get();

        return view('guru.tugas.create', compact('guruKelas', 'guruKelasTerpilih'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_kelas_id' => 'nullable|exists:guru_kelas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'judul' => 'required|string|max:255',
            'instruksi' => 'nullable|string',
            'deadline' => 'required|date',
            'file' => 'nullable|file|max:5120',
        ]);

        $bolehMengajar = GuruKelas::where('guru_id', Auth::id())
            ->where('kelas_id', $request->kelas_id)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->exists();

        if (!$bolehMengajar) {
            abort(403, 'Kamu tidak memiliki akses membuat tugas pada kelas dan mata pelajaran ini.');
        }

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tugas', 'public');
        }

        Tugas::create([
            'guru_id' => Auth::id(),
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'judul' => $request->judul,
            'instruksi' => $request->instruksi,
            'deadline' => $request->deadline,
            'file' => $filePath,
        ]);

        if ($request->filled('guru_kelas_id')) {
            return redirect()
                ->route('guru.mapel.tugas', $request->guru_kelas_id)
                ->with('success', 'Tugas berhasil ditambahkan.');
        }

        return redirect()
            ->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses ke tugas ini.');
        }

        $tugas->load(['kelas', 'mataPelajaran', 'guru', 'pengumpulan.siswa']);

        return view('guru.tugas.show', compact('tugas'));
    }

    public function edit(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses untuk mengedit tugas ini.');
        }

        $guruKelas = GuruKelas::with(['kelas', 'mataPelajaran'])
            ->where('guru_id', Auth::id())
            ->get();

        return view('guru.tugas.edit', compact('tugas', 'guruKelas'));
    }

    public function update(Request $request, Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses untuk mengubah tugas ini.');
        }

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'judul' => 'required|string|max:255',
            'instruksi' => 'nullable|string',
            'deadline' => 'required|date',
            'file' => 'nullable|file|max:5120',
        ]);

        $bolehMengajar = GuruKelas::where('guru_id', Auth::id())
            ->where('kelas_id', $request->kelas_id)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->exists();

        if (!$bolehMengajar) {
            abort(403, 'Kamu tidak memiliki akses mengubah tugas pada kelas dan mata pelajaran ini.');
        }

        $filePath = $tugas->file;

        if ($request->hasFile('file')) {
            if ($tugas->file && Storage::disk('public')->exists($tugas->file)) {
                Storage::disk('public')->delete($tugas->file);
            }

            $filePath = $request->file('file')->store('tugas', 'public');
        }

        $tugas->update([
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'judul' => $request->judul,
            'instruksi' => $request->instruksi,
            'deadline' => $request->deadline,
            'file' => $filePath,
        ]);

        return redirect()
            ->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
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
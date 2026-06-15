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
        $materi = Materi::with(['kelas', 'mataPelajaran'])
            ->where('guru_id', Auth::id())
            ->latest()
            ->get();

        return view('guru.materi.index', compact('materi'));
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

        return view('guru.materi.create', compact('guruKelas', 'guruKelasTerpilih'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_kelas_id' => 'nullable|exists:guru_kelas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:5120',
            'is_active' => 'required|boolean',
        ]);

        $bolehMengajar = GuruKelas::where('guru_id', Auth::id())
            ->where('kelas_id', $request->kelas_id)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->exists();

        if (!$bolehMengajar) {
            abort(403, 'Kamu tidak memiliki akses untuk membuat materi pada kelas dan mata pelajaran ini.');
        }

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materi', 'public');
        }

        Materi::create([
            'guru_id' => Auth::id(),
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
            'is_active' => $request->is_active,
        ]);

        if ($request->filled('guru_kelas_id')) {
            return redirect()
                ->route('guru.mapel.materi', $request->guru_kelas_id)
                ->with('success', 'Materi berhasil ditambahkan.');
        }

        return redirect()
            ->route('guru.materi.index')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(Materi $materi)
    {
        if ($materi->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses ke materi ini.');
        }

        $materi->load(['kelas', 'mataPelajaran', 'guru']);

        return view('guru.materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        if ($materi->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses untuk mengedit materi ini.');
        }

        $guruKelas = GuruKelas::with(['kelas', 'mataPelajaran'])
            ->where('guru_id', Auth::id())
            ->get();

        return view('guru.materi.edit', compact('materi', 'guruKelas'));
    }

    public function update(Request $request, Materi $materi)
    {
        if ($materi->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses untuk mengubah materi ini.');
        }

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:5120',
            'is_active' => 'nullable|boolean',
        ]);

        $bolehMengajar = GuruKelas::where('guru_id', Auth::id())
            ->where('kelas_id', $request->kelas_id)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->exists();

        if (!$bolehMengajar) {
            abort(403, 'Kamu tidak memiliki akses untuk mengubah materi pada kelas dan mata pelajaran ini.');
        }

        $filePath = $materi->file;

        if ($request->hasFile('file')) {
            if ($materi->file && Storage::disk('public')->exists($materi->file)) {
                Storage::disk('public')->delete($materi->file);
            }

            $filePath = $request->file('file')->store('materi', 'public');
        }

        $materi->update([
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()
            ->route('guru.materi.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses untuk menghapus materi ini.');
        }

        if ($materi->file && Storage::disk('public')->exists($materi->file)) {
            Storage::disk('public')->delete($materi->file);
        }

        $materi->delete();

        return redirect()
            ->route('guru.materi.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
}
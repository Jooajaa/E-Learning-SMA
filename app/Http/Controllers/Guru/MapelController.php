<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\GuruKelas;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\Kuis;
use Illuminate\Support\Facades\Auth;

class MapelController extends Controller
{
    public function index()
    {
        $guruKelas = GuruKelas::with(['kelas', 'mataPelajaran'])
            ->where('guru_id', Auth::id())
            ->get();

        return view('guru.mapel.index', compact('guruKelas'));
    }

    public function show(GuruKelas $guruKelas)
    {
        if ($guruKelas->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses.');
        }

        $guruKelas->load(['kelas', 'mataPelajaran']);

        $materiCount = Materi::where('guru_id', Auth::id())
            ->where('kelas_id', $guruKelas->kelas_id)
            ->where('mata_pelajaran_id', $guruKelas->mata_pelajaran_id)
            ->count();

        $tugasCount = Tugas::where('guru_id', Auth::id())
            ->where('kelas_id', $guruKelas->kelas_id)
            ->where('mata_pelajaran_id', $guruKelas->mata_pelajaran_id)
            ->count();

        $kuisCount = Kuis::where('guru_id', Auth::id())
            ->where('kelas_id', $guruKelas->kelas_id)
            ->where('mata_pelajaran_id', $guruKelas->mata_pelajaran_id)
            ->count();

        return view('guru.mapel.show', compact(
            'guruKelas',
            'materiCount',
            'tugasCount',
            'kuisCount'
        ));
    }

    public function materi(GuruKelas $guruKelas)
    {
        if ($guruKelas->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses.');
        }

        $guruKelas->load(['kelas', 'mataPelajaran']);

        $materi = Materi::with(['kelas', 'mataPelajaran'])
            ->where('guru_id', Auth::id())
            ->where('kelas_id', $guruKelas->kelas_id)
            ->where('mata_pelajaran_id', $guruKelas->mata_pelajaran_id)
            ->latest()
            ->get();

        return view('guru.mapel.materi', compact('guruKelas', 'materi'));
    }

    public function tugas(GuruKelas $guruKelas)
    {
        if ($guruKelas->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses.');
        }

        $guruKelas->load(['kelas', 'mataPelajaran']);

        $tugas = Tugas::with(['kelas', 'mataPelajaran', 'pengumpulan'])
            ->where('guru_id', Auth::id())
            ->where('kelas_id', $guruKelas->kelas_id)
            ->where('mata_pelajaran_id', $guruKelas->mata_pelajaran_id)
            ->latest()
            ->get();

        return view('guru.mapel.tugas', compact('guruKelas', 'tugas'));
    }

    public function kuis(GuruKelas $guruKelas)
    {
        if ($guruKelas->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses.');
        }

        $guruKelas->load(['kelas', 'mataPelajaran']);

        $kuis = Kuis::with(['kelas', 'mataPelajaran', 'soal'])
            ->where('guru_id', Auth::id())
            ->where('kelas_id', $guruKelas->kelas_id)
            ->where('mata_pelajaran_id', $guruKelas->mata_pelajaran_id)
            ->latest()
            ->get();

        return view('guru.mapel.kuis', compact('guruKelas', 'kuis'));
    }
}
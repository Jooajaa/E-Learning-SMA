<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\Kuis;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Auth;

class MapelController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('siswaKelas.kelas.guruKelas.mataPelajaran');

        $kelas = $user->siswaKelas->kelas ?? null;

        if (!$kelas) {
            return view('siswa.mapel.index', [
                'mapel' => collect(),
                'kelas' => null,
            ]);
        }

        $mapel = $kelas->guruKelas
            ->pluck('mataPelajaran')
            ->filter()
            ->unique('id')
            ->values();

        return view('siswa.mapel.index', compact('mapel', 'kelas'));
    }

    public function show(MataPelajaran $mapel)
    {
        $user = Auth::user()->load('siswaKelas.kelas.guruKelas.mataPelajaran');

        $kelas = $user->siswaKelas->kelas ?? null;

        if (!$kelas) {
            abort(403, 'Kamu belum memiliki kelas.');
        }

        $bolehAkses = $kelas->guruKelas
            ->where('mata_pelajaran_id', $mapel->id)
            ->count() > 0;

        if (!$bolehAkses) {
            abort(403, 'Kamu tidak memiliki akses ke mata pelajaran ini.');
        }

        $materiCount = Materi::where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->count();

        $tugasCount = Tugas::where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->count();

        $kuisCount = Kuis::where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->count();

        return view('siswa.mapel.show', compact(
            'mapel',
            'kelas',
            'materiCount',
            'tugasCount',
            'kuisCount'
        ));
    }

    public function materi(MataPelajaran $mapel)
    {
        $kelas = Auth::user()->siswaKelas->kelas ?? null;

        if (!$kelas) {
            abort(403, 'Kamu belum memiliki kelas.');
        }

        $materi = Materi::with(['guru', 'kelas', 'mataPelajaran'])
            ->where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('siswa.mapel.materi', compact('materi', 'mapel', 'kelas'));
    }

    public function tugas(MataPelajaran $mapel)
    {
        $kelas = Auth::user()->siswaKelas->kelas ?? null;

        if (!$kelas) {
            abort(403, 'Kamu belum memiliki kelas.');
        }

        $tugas = Tugas::with(['guru', 'kelas', 'mataPelajaran', 'pengumpulan'])
            ->where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->latest()
            ->get();

        $pengumpulanTugas = PengumpulanTugas::where('siswa_id', Auth::id())
            ->get()
            ->keyBy('tugas_id');

        return view('siswa.mapel.tugas', compact(
            'tugas',
            'pengumpulanTugas',
            'mapel',
            'kelas'
        ));
    }

    public function kuis(MataPelajaran $mapel)
    {
        $kelas = Auth::user()->siswaKelas->kelas ?? null;

        if (!$kelas) {
            abort(403, 'Kamu belum memiliki kelas.');
        }

        $kuis = Kuis::with(['guru', 'kelas', 'mataPelajaran', 'soal'])
            ->where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->latest()
            ->get();

        $kuisSudahDikerjakan = [];

        return view('siswa.mapel.kuis', compact(
            'kuis',
            'kuisSudahDikerjakan',
            'mapel',
            'kelas'
        ));
    }
}
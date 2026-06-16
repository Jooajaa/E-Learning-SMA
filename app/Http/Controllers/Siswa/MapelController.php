<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\Kuis;
use App\Models\Nilai;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Auth;

class MapelController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('siswaKelas.kelas.guruKelas.mataPelajaran', 'siswaKelas.kelas.guruKelas.guru');

        $kelas = $user->siswaKelas->kelas ?? null;

        $mapel = collect();

        if ($kelas) {
            $mapel = $kelas->guruKelas
                ->filter(function ($item) {
                    return $item->mataPelajaran !== null;
                })
                ->map(function ($item) {
                    $mataPelajaran = $item->mataPelajaran;
                    $mataPelajaran->guru_name = $item->guru->name ?? '-';
                    return $mataPelajaran;
                })
                ->unique('id')
                ->values();
        }

        return view('siswa.mapel.index', compact('kelas', 'mapel'));
    }

    public function show($mapel)
    {
        $user = Auth::user()->load('siswaKelas.kelas');

        $kelas = $user->siswaKelas->kelas ?? null;

        if (!$kelas) {
            abort(403, 'Kamu belum memiliki kelas.');
        }

        $mapel = MataPelajaran::findOrFail($mapel);

        $materiCount = Materi::where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->where('is_active', 1)
            ->count();

        $tugasCount = Tugas::where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->count();

        $kuisCount = Kuis::where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->count();

        return view('siswa.mapel.show', compact(
            'kelas',
            'mapel',
            'materiCount',
            'tugasCount',
            'kuisCount'
        ));
    }

    public function materi($mapel)
    {
        $user = Auth::user()->load('siswaKelas.kelas');

        $kelas = $user->siswaKelas->kelas ?? null;

        if (!$kelas) {
            abort(403, 'Kamu belum memiliki kelas.');
        }

        $mapel = MataPelajaran::findOrFail($mapel);

        $materi = Materi::with(['guru', 'kelas', 'mataPelajaran'])
            ->where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->where('is_active', 1)
            ->latest()
            ->get();

        return view('siswa.mapel.materi', compact(
            'kelas',
            'mapel',
            'materi'
        ));
    }

    public function tugas($mapel)
    {
        $user = Auth::user()->load('siswaKelas.kelas');

        $kelas = $user->siswaKelas->kelas ?? null;

        if (!$kelas) {
            abort(403, 'Kamu belum memiliki kelas.');
        }

        $mapel = MataPelajaran::findOrFail($mapel);

        $tugas = Tugas::with(['guru', 'kelas', 'mataPelajaran'])
            ->where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->latest()
            ->get();

        $pengumpulanTugas = PengumpulanTugas::where('siswa_id', Auth::id())
            ->get()
            ->keyBy('tugas_id');

        $mataPelajaranId = $mapel->id;

        return view('siswa.tugas.index', compact(
            'kelas',
            'mapel',
            'tugas',
            'pengumpulanTugas',
            'mataPelajaranId'
        ));
    }

    public function kuis($mapel)
    {
        $user = Auth::user()->load('siswaKelas.kelas');

        $kelas = $user->siswaKelas->kelas ?? null;

        if (!$kelas) {
            abort(403, 'Kamu belum memiliki kelas.');
        }

        $mapel = MataPelajaran::findOrFail($mapel);

        $kuis = Kuis::with(['guru', 'kelas', 'mataPelajaran', 'soal'])
            ->where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->latest()
            ->get();

        $kuisSudahDikerjakan = Nilai::where('siswa_id', Auth::id())
            ->whereNotNull('kuis_id')
            ->pluck('kuis_id')
            ->toArray();

        $mataPelajaranId = $mapel->id;

        return view('siswa.mapel.kuis', compact(
            'kelas',
            'mapel',
            'kuis',
            'kuisSudahDikerjakan',
            'mataPelajaranId'
        ));
    }
}
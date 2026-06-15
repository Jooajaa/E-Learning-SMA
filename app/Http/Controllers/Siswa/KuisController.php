<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use App\Models\JawabanKuis;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuisController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->load('siswaKelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;
        $mataPelajaranId = $request->mata_pelajaran_id;

        $kuisQuery = Kuis::with(['soal', 'guru', 'kelas', 'mataPelajaran'])
            ->where('kelas_id', $kelasId);

        if ($mataPelajaranId) {
            $kuisQuery->where('mata_pelajaran_id', $mataPelajaranId);
        }

        $kuis = $kuisQuery->latest()->get();

        $kuisSudahDikerjakan = Nilai::where('siswa_id', Auth::id())
            ->whereNotNull('kuis_id')
            ->pluck('kuis_id')
            ->toArray();

        return view('siswa.kuis.index', compact(
            'kuis',
            'kuisSudahDikerjakan',
            'mataPelajaranId'
        ));
    }

    public function kerjakan(Request $request, Kuis $kuis)
    {
        $user = Auth::user()->load('siswaKelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;
        $mataPelajaranId = $request->mata_pelajaran_id ?? $kuis->mata_pelajaran_id;

        if ($kuis->kelas_id != $kelasId) {
            abort(403, 'Kamu tidak memiliki akses ke kuis ini.');
        }

        if ($mataPelajaranId && $kuis->mata_pelajaran_id != $mataPelajaranId) {
            abort(403, 'Kuis ini bukan untuk mata pelajaran yang kamu pilih.');
        }

        $sudahDikerjakan = Nilai::where('siswa_id', Auth::id())
            ->where('kuis_id', $kuis->id)
            ->exists();

        if ($sudahDikerjakan) {
            return redirect()
                ->route('siswa.mapel.kuis', $kuis->mata_pelajaran_id)
                ->with('error', 'Kuis ini sudah kamu kerjakan.');
        }

        $kuis->load(['soal', 'mataPelajaran', 'kelas']);

        return view('siswa.kuis.kerjakan', compact('kuis', 'mataPelajaranId'));
    }

    public function submit(Request $request, Kuis $kuis)
    {
        $user = Auth::user()->load('siswaKelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;
        $mataPelajaranId = $request->mata_pelajaran_id ?? $kuis->mata_pelajaran_id;

        if ($kuis->kelas_id != $kelasId) {
            abort(403, 'Kamu tidak memiliki akses ke kuis ini.');
        }

        if ($mataPelajaranId && $kuis->mata_pelajaran_id != $mataPelajaranId) {
            abort(403, 'Kuis ini bukan untuk mata pelajaran yang kamu pilih.');
        }

        $sudahDikerjakan = Nilai::where('siswa_id', Auth::id())
            ->where('kuis_id', $kuis->id)
            ->exists();

        if ($sudahDikerjakan) {
            return redirect()
                ->route('siswa.mapel.kuis', $kuis->mata_pelajaran_id)
                ->with('error', 'Kuis ini sudah pernah kamu kerjakan.');
        }

        $kuis->load('soal');

        $benar = 0;
        $total = $kuis->soal->count();

        foreach ($kuis->soal as $soal) {
            $jawabanSiswa = $request->jawaban[$soal->id] ?? null;

            JawabanKuis::create([
                'kuis_id' => $kuis->id,
                'soal_kuis_id' => $soal->id,
                'siswa_id' => Auth::id(),
                'jawaban' => $jawabanSiswa,
                'is_benar' => $jawabanSiswa === $soal->jawaban_benar,
            ]);

            if ($jawabanSiswa === $soal->jawaban_benar) {
                $benar++;
            }
        }

        $nilaiAkhir = $total > 0 ? round(($benar / $total) * 100) : 0;

        Nilai::create([
            'siswa_id' => Auth::id(),
            'guru_id' => $kuis->guru_id,
            'kuis_id' => $kuis->id,
            'mata_pelajaran_id' => $kuis->mata_pelajaran_id,
            'nilai' => $nilaiAkhir,
            'keterangan' => 'Nilai dari kuis: ' . $kuis->judul,
        ]);

        return redirect()
            ->route('siswa.mapel.kuis', $kuis->mata_pelajaran_id)
            ->with('success', 'Kuis berhasil dikumpulkan. Nilai kamu: ' . $nilaiAkhir);
    }
}
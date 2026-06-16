<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->load('siswaKelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;
        $mataPelajaranId = $request->query('mata_pelajaran_id');

        $tugasQuery = Tugas::with(['guru', 'kelas', 'mataPelajaran'])
            ->where('kelas_id', $kelasId);

        if ($mataPelajaranId) {
            $tugasQuery->where('mata_pelajaran_id', $mataPelajaranId);
        }

        $tugas = $tugasQuery
            ->latest()
            ->get();

        $pengumpulanTugas = PengumpulanTugas::where('siswa_id', Auth::id())
            ->get()
            ->keyBy('tugas_id');

        return view('siswa.tugas.index', compact(
            'tugas',
            'pengumpulanTugas',
            'mataPelajaranId'
        ));
    }

    public function show(Request $request, Tugas $tugas)
    {
        $user = Auth::user()->load('siswaKelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;
        $mataPelajaranId = $request->query('mata_pelajaran_id') ?? $tugas->mata_pelajaran_id;

        if ($tugas->kelas_id != $kelasId) {
            abort(403, 'Kamu tidak memiliki akses ke tugas ini.');
        }

        if ($mataPelajaranId && $tugas->mata_pelajaran_id != $mataPelajaranId) {
            abort(403, 'Tugas ini bukan untuk mata pelajaran yang kamu pilih.');
        }

        $tugas->load(['guru', 'kelas', 'mataPelajaran']);

        $pengumpulan = PengumpulanTugas::where('tugas_id', $tugas->id)
            ->where('siswa_id', Auth::id())
            ->first();

        return view('siswa.tugas.show', compact(
            'tugas',
            'pengumpulan',
            'mataPelajaranId'
        ));
    }
}
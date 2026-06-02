<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('siswaKelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;

        $tugas = Tugas::with(['guru', 'kelas'])
            ->where('kelas_id', $kelasId)
            ->latest()
            ->get();

        $pengumpulanTugas = PengumpulanTugas::where('siswa_id', Auth::id())
            ->get()
            ->keyBy('tugas_id');

        return view('siswa.tugas.index', compact('tugas', 'pengumpulanTugas'));
    }

    public function show(Tugas $tugas)
    {
        $user = Auth::user()->load('siswaKelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;

        if ($tugas->kelas_id != $kelasId) {
            abort(403, 'Kamu tidak memiliki akses ke tugas ini.');
        }

        $tugas->load(['guru', 'kelas']);

        $pengumpulan = PengumpulanTugas::where('tugas_id', $tugas->id)
            ->where('siswa_id', Auth::id())
            ->first();

        return view('siswa.tugas.show', compact('tugas', 'pengumpulan'));
    }
}
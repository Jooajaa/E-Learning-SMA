<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\GuruKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $guruKelasId = $request->query('guru_kelas_id');

        $guruKelas = null;

        $nilaiKuisQuery = Nilai::with(['siswa', 'guru', 'kuis', 'mataPelajaran'])
            ->where('guru_id', Auth::id())
            ->whereNotNull('kuis_id')
            ->latest();

        $nilaiTugasQuery = Nilai::with(['siswa', 'guru', 'tugas', 'mataPelajaran'])
            ->where('guru_id', Auth::id())
            ->whereNotNull('tugas_id')
            ->latest();

        if ($guruKelasId) {
            $guruKelas = GuruKelas::with(['kelas', 'mataPelajaran'])
                ->where('id', $guruKelasId)
                ->where('guru_id', Auth::id())
                ->firstOrFail();

            $nilaiKuisQuery->where('mata_pelajaran_id', $guruKelas->mata_pelajaran_id);

            $nilaiTugasQuery->where('mata_pelajaran_id', $guruKelas->mata_pelajaran_id);
        }

        $nilaiKuis = $nilaiKuisQuery->get();
        $nilaiTugas = $nilaiTugasQuery->get();

        return view('guru.nilai.index', compact(
            'nilaiKuis',
            'nilaiTugas',
            'guruKelas',
            'guruKelasId'
        ));
    }
}
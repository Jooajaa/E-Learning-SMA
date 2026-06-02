<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\PengumpulanTugas;
use App\Models\GuruKelas;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $kelasIds = GuruKelas::where('guru_id', Auth::id())
            ->pluck('kelas_id')
            ->toArray();

        $nilaiKuis = Nilai::with(['siswa', 'kuis', 'kuis.kelas'])
            ->where('guru_id', Auth::id())
            ->whereHas('kuis', function ($query) use ($kelasIds) {
                $query->whereIn('kelas_id', $kelasIds);
            })
            ->latest()
            ->get();

        $nilaiTugas = PengumpulanTugas::with(['siswa', 'tugas', 'tugas.kelas'])
            ->whereHas('tugas', function ($query) use ($kelasIds) {
                $query->where('guru_id', Auth::id())
                    ->whereIn('kelas_id', $kelasIds);
            })
            ->whereNotNull('nilai')
            ->latest()
            ->get();

        return view('guru.nilai.index', compact('nilaiKuis', 'nilaiTugas'));
    }
}
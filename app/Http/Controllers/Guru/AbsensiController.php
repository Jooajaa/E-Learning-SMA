<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\GuruKelas;
use App\Models\SiswaKelas;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $kelasIds = GuruKelas::where('guru_id', Auth::id())
            ->pluck('kelas_id')
            ->toArray();

        $siswaIds = SiswaKelas::whereIn('kelas_id', $kelasIds)
            ->pluck('siswa_id')
            ->toArray();

        $absensi = Absensi::with(['siswa.siswaKelas.kelas'])
            ->whereIn('siswa_id', $siswaIds)
            ->latest()
            ->get();

        return view('guru.absensi.index', compact('absensi'));
    }
}
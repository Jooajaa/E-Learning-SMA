<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\GuruKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $guruKelasId = $request->query('guru_kelas_id');

        $guruKelas = null;
        $absensiQuery = Absensi::with(['siswa', 'kelas', 'mataPelajaran'])
            ->latest();

        if ($guruKelasId) {
            $guruKelas = GuruKelas::with(['kelas', 'mataPelajaran'])
                ->where('id', $guruKelasId)
                ->where('guru_id', Auth::id())
                ->firstOrFail();

            $absensiQuery->where('kelas_id', $guruKelas->kelas_id)
                ->where('mata_pelajaran_id', $guruKelas->mata_pelajaran_id);
        } else {
            $guruKelasIds = GuruKelas::where('guru_id', Auth::id())
                ->get();

            $kelasIds = $guruKelasIds->pluck('kelas_id')->toArray();
            $mapelIds = $guruKelasIds->pluck('mata_pelajaran_id')->toArray();

            $absensiQuery->whereIn('kelas_id', $kelasIds)
                ->whereIn('mata_pelajaran_id', $mapelIds);
        }

        $absensi = $absensiQuery->get();

        return view('guru.absensi.index', compact(
            'absensi',
            'guruKelas',
            'guruKelasId'
        ));
    }
}
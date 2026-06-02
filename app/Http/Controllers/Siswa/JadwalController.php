<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('siswaKelas.kelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;

        $jadwal = JadwalPelajaran::with(['kelas', 'guru', 'mataPelajaran'])
            ->where('kelas_id', $kelasId)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->get();

        return view('siswa.jadwal.index', compact('jadwal', 'user'));
    }
}
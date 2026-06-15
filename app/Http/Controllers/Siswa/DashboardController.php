<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('siswaKelas.kelas.guruKelas.mataPelajaran');

        $kelas = $user->siswaKelas->kelas ?? null;

        $mapel = collect();

        if ($kelas) {
            $mapel = $kelas->guruKelas
                ->pluck('mataPelajaran')
                ->filter()
                ->unique('id')
                ->values();
        }

        return view('siswa.dashboard', compact('kelas', 'mapel'));
    }
}
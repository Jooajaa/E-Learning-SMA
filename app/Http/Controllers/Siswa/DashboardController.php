<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load([
            'siswaKelas.kelas.guruKelas.guru',
            'siswaKelas.kelas.guruKelas.mataPelajaran',
        ]);

        return view('siswa.dashboard', compact('user'));
    }
}
<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with('siswa')
            ->latest()
            ->get();

        return view('guru.absensi.index', compact('absensi'));
    }
}
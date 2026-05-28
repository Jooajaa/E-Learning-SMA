<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPelajaran::latest()->get();

        return view('siswa.jadwal.index', compact('jadwal'));
    }
}
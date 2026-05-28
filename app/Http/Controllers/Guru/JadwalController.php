<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPelajaran::latest()->get();

        return view('guru.jadwal.index', compact('jadwal'));
    }
}
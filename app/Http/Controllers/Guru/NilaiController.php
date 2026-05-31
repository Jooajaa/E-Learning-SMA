<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\PengumpulanTugas;

class NilaiController extends Controller
{
    public function index()
    {
        $nilaiKuis = Nilai::latest()->get();

        $nilaiTugas = PengumpulanTugas::with(['tugas', 'siswa'])
            ->whereNotNull('nilai')
            ->latest()
            ->get();

        return view('guru.nilai.index', compact('nilaiKuis', 'nilaiTugas'));
    }
}
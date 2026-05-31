<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $nilaiKuis = Nilai::where('siswa_id', Auth::id())
            ->latest()
            ->get();

        $nilaiTugas = PengumpulanTugas::with('tugas')
            ->where('siswa_id', Auth::id())
            ->whereNotNull('nilai')
            ->latest()
            ->get();

        return view('siswa.nilai.index', compact('nilaiKuis', 'nilaiTugas'));
    }
}
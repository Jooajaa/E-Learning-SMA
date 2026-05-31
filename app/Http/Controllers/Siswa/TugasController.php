<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tugas;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::latest()->get();

        return view('siswa.tugas.index', compact('tugas'));
    }

    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);

        $pengumpulan = \App\Models\PengumpulanTugas::where('tugas_id', $id)
            ->where('siswa_id', auth()->id())
            ->first();

        return view(
            'siswa.tugas.show',
            compact('tugas', 'pengumpulan')
        );
    }
}
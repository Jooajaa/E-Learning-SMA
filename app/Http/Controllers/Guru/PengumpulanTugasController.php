<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;

class PengumpulanTugasController extends Controller
{
    public function index()
    {
        $pengumpulan = PengumpulanTugas::with(['tugas', 'siswa'])
            ->latest()
            ->get();

        return view('guru.pengumpulan.index', compact('pengumpulan'));
    }

    public function beriNilai(Request $request, PengumpulanTugas $pengumpulan)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
            'komentar' => 'nullable|string',
        ]);

        $pengumpulan->forceFill([
            'nilai' => $request->nilai,
            'komentar' => $request->komentar,
        ])->save();

        return redirect()
            ->route('guru.pengumpulan.index')
            ->with('success', 'Nilai tugas berhasil disimpan.');
    }
}
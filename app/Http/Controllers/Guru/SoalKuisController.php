<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use App\Models\SoalKuis;
use Illuminate\Http\Request;

class SoalKuisController extends Controller
{
    public function create(Kuis $kuis)
    {
        return view('guru.kuis.soal-create', compact('kuis'));
    }

    public function store(Request $request, Kuis $kuis)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string|max:255',
            'pilihan_b' => 'required|string|max:255',
            'pilihan_c' => 'required|string|max:255',
            'pilihan_d' => 'required|string|max:255',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        SoalKuis::create([
            'kuis_id' => $kuis->id,
            'pertanyaan' => $request->pertanyaan,
            'pilihan_a' => $request->pilihan_a,
            'pilihan_b' => $request->pilihan_b,
            'pilihan_c' => $request->pilihan_c,
            'pilihan_d' => $request->pilihan_d,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return redirect()
    ->route('guru.kuis.soal.create', $kuis->id)
    ->with('success', 'Soal berhasil ditambahkan. Silakan tambah soal berikutnya.');
    }
}
<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use App\Models\JawabanKuis;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::with('soal')->latest()->get();

        return view('siswa.kuis.index', compact('kuis'));
    }

    public function kerjakan(Kuis $kuis)
    {
        $kuis->load('soal');

        return view('siswa.kuis.kerjakan', compact('kuis'));
    }

    public function submit(Request $request, Kuis $kuis)
    {
        $kuis->load('soal');

        $benar = 0;
        $jumlahSoal = $kuis->soal->count();

        if ($jumlahSoal == 0) {
            return redirect()
                ->route('siswa.kuis.index')
                ->with('error', 'Kuis belum memiliki soal.');
        }

        foreach ($kuis->soal as $soal) {
            $jawabanSiswa = $request->input('jawaban_' . $soal->id);

            $isBenar = $jawabanSiswa === $soal->jawaban_benar;

            if ($isBenar) {
                $benar++;
            }

            JawabanKuis::create([
                'kuis_id' => $kuis->id,
                'soal_kuis_id' => $soal->id,
                'siswa_id' => Auth::id(),
                'jawaban' => $jawabanSiswa,
                'benar' => $isBenar,
            ]);
        }

        $nilaiAkhir = round(($benar / $jumlahSoal) * 100);

        Nilai::create([
            'siswa_id' => Auth::id(),
            'guru_id' => $kuis->guru_id,
            'kuis_id' => $kuis->id,
            'nilai' => $nilaiAkhir,
            'keterangan' => 'Nilai dari kuis: ' . $kuis->judul,
        ]);

        return redirect()
            ->route('siswa.nilai.index')
            ->with('success', 'Kuis berhasil dikumpulkan. Nilai kamu: ' . $nilaiAkhir);
    }
}
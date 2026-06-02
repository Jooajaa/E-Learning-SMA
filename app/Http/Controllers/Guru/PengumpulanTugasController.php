<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use App\Models\GuruKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumpulanTugasController extends Controller
{
    public function index(Request $request)
    {
        $kelasIds = GuruKelas::where('guru_id', Auth::id())
            ->pluck('kelas_id')
            ->toArray();

        $pengumpulan = PengumpulanTugas::with(['tugas', 'tugas.kelas', 'siswa'])
            ->whereHas('tugas', function ($query) use ($kelasIds, $request) {
                $query->where('guru_id', Auth::id())
                    ->whereIn('kelas_id', $kelasIds);

                if ($request->filled('tugas_id')) {
                    $query->where('id', $request->tugas_id);
                }
            })
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

        $kelasIds = GuruKelas::where('guru_id', Auth::id())
            ->pluck('kelas_id')
            ->toArray();

        $pengumpulan->load('tugas');

        if (
            !$pengumpulan->tugas ||
            $pengumpulan->tugas->guru_id != Auth::id() ||
            !in_array($pengumpulan->tugas->kelas_id, $kelasIds)
        ) {
            abort(403, 'Kamu tidak memiliki akses untuk menilai tugas ini.');
        }

        $pengumpulan->update([
            'nilai' => $request->nilai,
            'komentar' => $request->komentar ?? $pengumpulan->komentar,
            'status' => 'dinilai',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Nilai tugas berhasil disimpan.');
    }
}
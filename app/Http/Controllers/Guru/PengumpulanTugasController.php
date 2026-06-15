<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use App\Models\GuruKelas;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumpulanTugasController extends Controller
{
    public function index(Request $request)
    {
        $guruKelasId = $request->query('guru_kelas_id');

        $guruKelas = null;

        $pengumpulanQuery = PengumpulanTugas::with([
                'siswa',
                'tugas',
                'tugas.kelas',
                'tugas.mataPelajaran'
            ])
            ->whereHas('tugas', function ($query) {
                $query->where('guru_id', Auth::id());
            })
            ->latest();

        if ($guruKelasId) {
            $guruKelas = GuruKelas::with(['kelas', 'mataPelajaran'])
                ->where('id', $guruKelasId)
                ->where('guru_id', Auth::id())
                ->firstOrFail();

            $pengumpulanQuery->whereHas('tugas', function ($query) use ($guruKelas) {
                $query->where('kelas_id', $guruKelas->kelas_id)
                    ->where('mata_pelajaran_id', $guruKelas->mata_pelajaran_id);
            });
        }

        $pengumpulan = $pengumpulanQuery->get();

        return view('guru.pengumpulan.index', compact(
            'pengumpulan',
            'guruKelas',
            'guruKelasId'
        ));
    }

    public function beriNilai(Request $request, PengumpulanTugas $pengumpulan)
    {
        $pengumpulan->load('tugas');

        if (!$pengumpulan->tugas || $pengumpulan->tugas->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses untuk menilai tugas ini.');
        }

        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'komentar_guru' => 'nullable|string',
            'guru_kelas_id' => 'nullable|exists:guru_kelas,id',
        ]);

        $pengumpulan->update([
            'nilai' => $request->nilai,
            'komentar_guru' => $request->komentar_guru,
            'status' => 'dinilai',
        ]);

        Nilai::updateOrCreate(
            [
                'siswa_id' => $pengumpulan->siswa_id,
                'tugas_id' => $pengumpulan->tugas_id,
            ],
            [
                'guru_id' => Auth::id(),
                'mata_pelajaran_id' => $pengumpulan->tugas->mata_pelajaran_id,
                'nilai' => $request->nilai,
                'keterangan' => $request->komentar_guru ?? 'Nilai dari tugas: ' . $pengumpulan->tugas->judul,
            ]
        );

        if ($request->filled('guru_kelas_id')) {
            return redirect()
                ->route('guru.pengumpulan.index', [
                    'guru_kelas_id' => $request->guru_kelas_id
                ])
                ->with('success', 'Nilai tugas berhasil disimpan.');
        }

        return redirect()
            ->route('guru.pengumpulan.index')
            ->with('success', 'Nilai tugas berhasil disimpan.');
    }
}
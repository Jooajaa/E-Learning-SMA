<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $mataPelajaranId = $request->query('mata_pelajaran_id');

        $mapel = null;

        if ($mataPelajaranId) {
            $mapel = MataPelajaran::find($mataPelajaranId);
        }

        $nilaiKuis = Nilai::with(['kuis', 'guru', 'mataPelajaran'])
            ->where('siswa_id', Auth::id())
            ->whereNotNull('kuis_id')
            ->when($mataPelajaranId, function ($query) use ($mataPelajaranId) {
                return $query->where('mata_pelajaran_id', $mataPelajaranId);
            })
            ->latest()
            ->get();

        $nilaiTugas = Nilai::with(['tugas', 'guru', 'mataPelajaran'])
            ->where('siswa_id', Auth::id())
            ->whereNotNull('tugas_id')
            ->when($mataPelajaranId, function ($query) use ($mataPelajaranId) {
                return $query->where('mata_pelajaran_id', $mataPelajaranId);
            })
            ->latest()
            ->get();

        return view('siswa.nilai.index', compact(
            'nilaiKuis',
            'nilaiTugas',
            'mataPelajaranId',
            'mapel'
        ));
    }
}
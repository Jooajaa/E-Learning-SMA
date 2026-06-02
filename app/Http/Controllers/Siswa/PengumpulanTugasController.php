<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumpulanTugasController extends Controller
{
    public function index()
    {
        $pengumpulan = PengumpulanTugas::with(['tugas', 'tugas.kelas'])
            ->where('siswa_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.pengumpulan.index', compact('pengumpulan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'file' => 'required|file|max:5120',
            'komentar' => 'nullable|string',
        ]);

        $tugas = Tugas::findOrFail($request->tugas_id);

        $user = Auth::user()->load('siswaKelas');
        $kelasId = $user->siswaKelas->kelas_id ?? null;

        if ($tugas->kelas_id != $kelasId) {
            abort(403, 'Kamu tidak memiliki akses untuk mengumpulkan tugas ini.');
        }

        $sudahMengumpulkan = PengumpulanTugas::where('tugas_id', $tugas->id)
            ->where('siswa_id', Auth::id())
            ->exists();

        if ($sudahMengumpulkan) {
            return redirect()
                ->route('siswa.tugas.index')
                ->with('error', 'Kamu sudah mengumpulkan tugas ini.');
        }

        $filePath = $request->file('file')->store('pengumpulan_tugas', 'public');

        PengumpulanTugas::create([
            'tugas_id' => $tugas->id,
            'siswa_id' => Auth::id(),
            'file' => $filePath,
            'status' => 'dikumpulkan',
            'nilai' => null,
            'komentar' => $request->komentar,
        ]);

        return redirect()
            ->route('siswa.tugas.index')
            ->with('success', 'Tugas berhasil dikumpulkan.');
    }
}
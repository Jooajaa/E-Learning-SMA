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
        $pengumpulan = PengumpulanTugas::with('tugas')
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
        ]);

        $tugas = Tugas::findOrFail($request->tugas_id);

        $filePath = $request->file('file')->store('pengumpulan-tugas', 'public');

        PengumpulanTugas::updateOrCreate(
            [
                'tugas_id' => $tugas->id,
                'siswa_id' => Auth::id(),
            ],
            [
                'file' => $filePath,
                'status' => 'dikumpulkan',
            ]
        );

        return redirect()
            ->route('siswa.tugas.index')
            ->with('success', 'Tugas berhasil dikumpulkan.');
    }
}
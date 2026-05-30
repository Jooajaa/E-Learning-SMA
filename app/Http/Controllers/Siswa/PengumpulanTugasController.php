<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;

class PengumpulanTugasController extends Controller
{
    public function index()
    {
        $pengumpulan = PengumpulanTugas::with('tugas')
            ->where('siswa_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'siswa.pengumpulan.index',
            compact('pengumpulan')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,zip|max:2048',
        ]);

        $file = $request->file('file')->store(
            'pengumpulan-tugas',
            'public'
        );

        PengumpulanTugas::create([
            'tugas_id' => $request->tugas_id,
            'siswa_id' => auth()->id(),
            'file' => $file,
            'status' => 'dikumpulkan',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Tugas berhasil dikumpulkan');
    }
}

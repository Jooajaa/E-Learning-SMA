<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;

class PengumpulanTugasController extends Controller
{
    public function index()
    {
        $pengumpulan = PengumpulanTugas::with(['siswa', 'tugas'])
            ->latest()
            ->get();

        return view('guru.pengumpulan.index', compact('pengumpulan'));
    }

    public function komentar(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        $pengumpulan = PengumpulanTugas::findOrFail($id);

        $pengumpulan->update([
            'komentar' => $request->komentar,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Komentar berhasil disimpan');
    }
}

<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('siswaKelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;

        $materi = Materi::with(['guru', 'kelas'])
            ->where('kelas_id', $kelasId)
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('siswa.materi.index', compact('materi'));
    }

    public function show(Materi $materi)
    {
        $user = Auth::user()->load('siswaKelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;

        if ($materi->kelas_id != $kelasId) {
            abort(403, 'Kamu tidak memiliki akses ke materi ini.');
        }

        $materi->load(['guru', 'kelas']);

        return view('siswa.materi.show', compact('materi'));
    }
}
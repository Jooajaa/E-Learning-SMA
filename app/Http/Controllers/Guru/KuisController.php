<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use App\Models\GuruKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::with(['soal', 'kelas'])
            ->where('guru_id', Auth::id())
            ->latest()
            ->get();

        return view('guru.kuis.index', compact('kuis'));
    }

    public function create()
    {
        $guruKelas = GuruKelas::with('kelas')
            ->where('guru_id', Auth::id())
            ->get();

        $kelas = $guruKelas->pluck('kelas')->filter();

        return view('guru.kuis.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
        ]);

        Kuis::create([
            'guru_id' => Auth::id(),
            'kelas_id' => $request->kelas_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi ?? '-',
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()
            ->route('guru.kuis.index')
            ->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function show(Kuis $kuis)
    {
        if ($kuis->guru_id != Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses ke kuis ini.');
        }

        $kuis->load(['soal', 'kelas']);

        return view('guru.kuis.show', compact('kuis'));
    }
}
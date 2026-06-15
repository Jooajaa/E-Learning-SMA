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
        $kuis = Kuis::with(['kelas', 'mataPelajaran', 'soal'])
            ->where('guru_id', Auth::id())
            ->latest()
            ->get();

        return view('guru.kuis.index', compact('kuis'));
    }

    public function create(Request $request)
    {
        $guruKelasTerpilih = null;

        if ($request->has('guru_kelas_id')) {
            $guruKelasTerpilih = GuruKelas::with(['kelas', 'mataPelajaran'])
                ->where('guru_id', Auth::id())
                ->where('id', $request->guru_kelas_id)
                ->firstOrFail();
        }

        $guruKelas = GuruKelas::with(['kelas', 'mataPelajaran'])
            ->where('guru_id', Auth::id())
            ->get();

        return view('guru.kuis.create', compact('guruKelas', 'guruKelasTerpilih'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_kelas_id' => 'nullable|exists:guru_kelas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        $bolehMengajar = GuruKelas::where('guru_id', Auth::id())
            ->where('kelas_id', $request->kelas_id)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->exists();

        if (!$bolehMengajar) {
            abort(403, 'Kamu tidak memiliki akses membuat kuis pada kelas dan mata pelajaran ini.');
        }

        $kuis = Kuis::create([
            'guru_id' => Auth::id(),
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        if ($request->filled('guru_kelas_id')) {
            return redirect()
                ->route('guru.mapel.kuis', $request->guru_kelas_id)
                ->with('success', 'Kuis berhasil ditambahkan.');
        }

        return redirect()
            ->route('guru.kuis.show', $kuis->id)
            ->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function show(Kuis $kuis)
    {
        if ($kuis->guru_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses ke kuis ini.');
        }

        $kuis->load(['kelas', 'mataPelajaran', 'soal']);

        return view('guru.kuis.show', compact('kuis'));
    }
}
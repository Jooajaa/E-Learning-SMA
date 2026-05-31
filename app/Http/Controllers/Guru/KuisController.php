<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::with('soal')->latest()->get();

        return view('guru.kuis.index', compact('kuis'));
    }

    public function create()
    {
        return view('guru.kuis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
        ]);

        Kuis::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()
            ->route('guru.kuis.index')
            ->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function show(Kuis $kuis)
    {
        $kuis->load('soal');

        return view('guru.kuis.show', compact('kuis'));
    }
}
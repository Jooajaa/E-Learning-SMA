<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kuis;

class KuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::with('soal')->latest()->get();

        return view('siswa.kuis.index', compact('kuis'));
    }
}
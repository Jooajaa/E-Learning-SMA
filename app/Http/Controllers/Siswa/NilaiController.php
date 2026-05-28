<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::where('siswa_id', Auth::id())->latest()->get();

        return view('siswa.nilai.index', compact('nilai'));
    }
}
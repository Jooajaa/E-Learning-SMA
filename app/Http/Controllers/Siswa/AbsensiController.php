<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::where('siswa_id', Auth::id())->latest()->get();

        return view('siswa.absensi.index', compact('absensi'));
    }
}
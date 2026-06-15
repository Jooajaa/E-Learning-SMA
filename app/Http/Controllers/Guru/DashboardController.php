<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\GuruKelas;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guruKelas = GuruKelas::with(['kelas', 'mataPelajaran'])
            ->where('guru_id', Auth::id())
            ->get();

        return view('guru.dashboard', compact('guruKelas'));
    }
}
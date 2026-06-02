<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('guruKelas.kelas', 'guruKelas.mapel');

        return view('guru.dashboard', compact('user'));
    }
}
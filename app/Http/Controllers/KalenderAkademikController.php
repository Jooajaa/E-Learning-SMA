<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;

class KalenderAkademikController extends Controller
{
    public function index()
    {
        $kalender = KalenderAkademik::orderBy('tanggal_mulai', 'asc')->get();

        return view('kalender.index', compact('kalender'));
    }
}
<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensiHariIni = Absensi::where('siswa_id', Auth::id())
            ->whereDate('tanggal', now()->toDateString())
            ->first();

        $absensi = Absensi::where('siswa_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.absensi.index', compact('absensiHariIni', 'absensi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $sudahAbsen = Absensi::where('siswa_id', Auth::id())
            ->whereDate('tanggal', now()->toDateString())
            ->exists();

        if ($sudahAbsen) {
            return redirect()
                ->route('siswa.absensi.index')
                ->with('error', 'Kamu sudah mengisi absensi hari ini.');
        }

        Absensi::create([
            'siswa_id' => Auth::id(),
            'guru_id' => null,
            'tanggal' => now()->toDateString(),
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('siswa.absensi.index')
            ->with('success', 'Absensi berhasil dikirim.');
    }
}
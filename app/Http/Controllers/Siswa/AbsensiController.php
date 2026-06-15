<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->load('siswaKelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;
        $mataPelajaranId = $request->query('mata_pelajaran_id');

        $mapel = null;

        if ($mataPelajaranId) {
            $mapel = MataPelajaran::find($mataPelajaranId);
        }

        $absensi = Absensi::with('mataPelajaran')
            ->where('siswa_id', Auth::id())
            ->where('kelas_id', $kelasId)
            ->when($mataPelajaranId, function ($query) use ($mataPelajaranId) {
                return $query->where('mata_pelajaran_id', $mataPelajaranId);
            })
            ->latest()
            ->get();

        $sudahAbsenHariIni = Absensi::where('siswa_id', Auth::id())
            ->where('kelas_id', $kelasId)
            ->when($mataPelajaranId, function ($query) use ($mataPelajaranId) {
                return $query->where('mata_pelajaran_id', $mataPelajaranId);
            })
            ->whereDate('tanggal', Carbon::today())
            ->exists();

        return view('siswa.absensi.index', compact(
            'absensi',
            'sudahAbsenHariIni',
            'mataPelajaranId',
            'mapel'
        ));
    }

    public function store(Request $request)
    {
        $user = Auth::user()->load('siswaKelas');

        $kelasId = $user->siswaKelas->kelas_id ?? null;

        $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'keterangan' => 'nullable|string',
        ]);

        $sudahAbsenHariIni = Absensi::where('siswa_id', Auth::id())
            ->where('kelas_id', $kelasId)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->whereDate('tanggal', Carbon::today())
            ->exists();

        if ($sudahAbsenHariIni) {
            return redirect()
                ->route('siswa.absensi.index', [
                    'mata_pelajaran_id' => $request->mata_pelajaran_id
                ])
                ->with('error', 'Kamu sudah mengisi absensi untuk mata pelajaran ini hari ini.');
        }

        Absensi::create([
            'siswa_id' => Auth::id(),
            'kelas_id' => $kelasId,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'tanggal' => Carbon::today(),
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('siswa.absensi.index', [
                'mata_pelajaran_id' => $request->mata_pelajaran_id
            ])
            ->with('success', 'Absensi berhasil dikirim.');
    }
}
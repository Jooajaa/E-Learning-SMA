<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruKelas;
use App\Models\GuruMapel;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\SiswaKelas;
use App\Models\User;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    public function index()
    {
        $siswa = User::role('siswa')
            ->where('status', 'aktif')
            ->orderBy('name')
            ->get();

        $guru = User::role('guru')
            ->where('status', 'aktif')
            ->orderBy('name')
            ->get();

        $kelas = Kelas::orderBy('nama_kelas')->get();
        $mapel = MataPelajaran::orderBy('nama_mapel')->get();

        $siswaKelas = SiswaKelas::with(['siswa', 'kelas'])->latest()->get();
        $guruMapel = GuruMapel::with(['guru', 'mataPelajaran'])->latest()->get();
        $guruKelas = GuruKelas::with(['guru', 'kelas', 'mataPelajaran'])->latest()->get();

        return view('admin.penugasan.index', compact(
            'siswa',
            'guru',
            'kelas',
            'mapel',
            'siswaKelas',
            'guruMapel',
            'guruKelas'
        ));
    }

    public function storeSiswaKelas(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        SiswaKelas::updateOrCreate(
            [
                'siswa_id' => $request->siswa_id,
                'tahun_ajaran' => $request->tahun_ajaran,
            ],
            [
                'kelas_id' => $request->kelas_id,
            ]
        );

        return redirect()
            ->route('admin.penugasan.index')
            ->with('success', 'Siswa berhasil ditugaskan ke kelas.');
    }

    public function storeGuruMapel(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
        ]);

        GuruMapel::firstOrCreate([
            'guru_id' => $request->guru_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
        ]);

        return redirect()
            ->route('admin.penugasan.index')
            ->with('success', 'Guru berhasil ditugaskan ke mata pelajaran.');
    }

    public function storeGuruKelas(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
        ]);

        GuruKelas::firstOrCreate([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
        ]);

        return redirect()
            ->route('admin.penugasan.index')
            ->with('success', 'Guru berhasil ditugaskan ke kelas.');
    }
}
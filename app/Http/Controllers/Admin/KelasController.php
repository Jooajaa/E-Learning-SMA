<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::latest()->paginate(10);

        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
    'nama_kelas' => 'required|string|max:255',
    'tingkat' => 'required|in:X,XI,XII',
    'jurusan' => 'required|in:IPA,IPS',
]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function show(Kelas $kela)
    {
        return redirect()->route('admin.kelas.index');
    }

    public function edit(Kelas $kela)
    {
        return view('admin.kelas.edit', [
            'kelas' => $kela,
        ]);
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:IPA,IPS',
        ]);

        $kela->update([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}
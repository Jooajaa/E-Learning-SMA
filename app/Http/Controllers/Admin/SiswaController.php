<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = User::role('siswa')
            ->latest()
            ->paginate(10);

        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:30|unique:users,nis',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $siswa = User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);

        $siswa->assignRole('siswa');

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(User $siswa)
    {
        return redirect()->route('admin.siswa.index');
    }

    public function edit(User $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, User $siswa)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:30|unique:users,nis,' . $siswa->id,
            'email' => 'required|email|max:255|unique:users,email,' . $siswa->id,
            'password' => 'nullable|string|min:6',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $data = [
            'name' => $request->name,
            'nis' => $request->nis,
            'email' => $request->email,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(User $siswa)
    {
        $siswa->update([
            'status' => 'nonaktif',
        ]);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dinonaktifkan.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $guru = User::role('guru')
            ->latest()
            ->paginate(10);

        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:30|unique:users,nip',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $guru = User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);

        $guru->assignRole('guru');

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function show(User $guru)
    {
        return redirect()->route('admin.guru.index');
    }

    public function edit(User $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, User $guru)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:30|unique:users,nip,' . $guru->id,
            'email' => 'required|email|max:255|unique:users,email,' . $guru->id,
            'password' => 'nullable|string|min:6',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $data = [
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $guru->update($data);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(User $guru)
    {
        $guru->update([
            'status' => 'nonaktif',
        ]);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dinonaktifkan.');
    }
}
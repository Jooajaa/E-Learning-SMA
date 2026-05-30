@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">
            Daftar Tugas
        </h1>

        <a href="{{ route('guru.tugas.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            + Tambah Tugas
        </a>

    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border">

        <thead class="bg-gray-100">

            <tr>
                <th class="border p-3">No</th>
                <th class="border p-3">Judul</th>
                <th class="border p-3">Deadline</th>
                <th class="border p-3">File</th>
                <th class="border p-3">Aksi</th>
            </tr>

        </thead>

        <tbody>

            @forelse($tugas as $item)

            <tr>

                <td class="border p-3">
                    {{ $loop->iteration }}
                </td>

                <td class="border p-3">
                    {{ $item->judul }}
                </td>

                <td class="border p-3">
                    {{ $item->deadline }}
                </td>

                <td class="border p-3">

                    @if($item->file)

                        <a href="{{ asset('storage/' . $item->file) }}"
                           target="_blank"
                           class="text-blue-600 underline">

                            Download

                        </a>

                    @else

                        -

                    @endif

                </td>

                <td class="border p-3">

                    <div class="flex gap-2">

                        <a href="{{ route('guru.tugas.show', $item->id) }}"
                           class="bg-green-500 text-white px-3 py-1 rounded">
                            Detail
                        </a>

                        <a href="{{ route('guru.tugas.edit', $item->id) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        <form action="{{ route('guru.tugas.destroy', $item->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 text-white px-3 py-1 rounded">
                                Hapus
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="5"
                    class="text-center p-5">

                    Belum ada tugas

                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
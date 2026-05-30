@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="bg-white shadow rounded-xl p-6">

        <h1 class="text-3xl font-bold mb-6">
            Daftar Pengumpulan Tugas
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="overflow-x-auto">

            <table class="w-full border">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-3">No</th>
                        <th class="border p-3">Siswa</th>
                        <th class="border p-3">Tugas</th>
                        <th class="border p-3">File Jawaban</th>
                        <th class="border p-3">Status</th>
                        <th class="border p-3">Komentar Guru</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($pengumpulan as $item)

                        <tr>
                            <td class="border p-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-3">
                                {{ $item->siswa->name ?? '-' }}
                            </td>

                            <td class="border p-3">
                                {{ $item->tugas->judul ?? '-' }}
                            </td>

                            <td class="border p-3">
                                <a href="{{ asset('storage/' . $item->file) }}"
                                   target="_blank"
                                   class="text-blue-600 underline">
                                    Download
                                </a>
                            </td>

                            <td class="border p-3">
                                {{ $item->status }}
                            </td>

                            <td class="border p-3">
                                <form action="{{ route('guru.pengumpulan.komentar', $item->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('PUT')

                                    <textarea name="komentar"
                                              rows="3"
                                              class="w-full border rounded p-2"
                                              placeholder="Tulis komentar guru...">{{ old('komentar', $item->komentar) }}</textarea>

                                    <button type="submit"
                                            class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                        Simpan
                                    </button>

                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center p-4">
                                Belum ada pengumpulan tugas
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
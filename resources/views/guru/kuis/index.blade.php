<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    Kuis Guru
                </h1>

                <p class="text-gray-600 mb-6">
                    Halaman ini digunakan guru untuk melihat dan mengelola kuis pilihan ganda.
                </p>

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('guru.kuis.create') }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg">
                        + Tambah Kuis
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">No</th>
                                <th class="border px-4 py-2 text-left">Judul</th>
                                <th class="border px-4 py-2 text-left">Deskripsi</th>
                                <th class="border px-4 py-2 text-left">Waktu Mulai</th>
                                <th class="border px-4 py-2 text-left">Waktu Selesai</th>
                                <th class="border px-4 py-2 text-left">Jumlah Soal</th>
                                <th class="border px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kuis as $item)
                                <tr>
                                    <td class="border px-4 py-2">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border px-4 py-2 font-semibold">
                                        {{ $item->judul }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $item->deskripsi }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $item->waktu_mulai }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $item->waktu_selesai }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $item->soal->count() }} soal
                                    </td>

                                    <td class="border px-4 py-2">
                                        <a href="{{ route('guru.kuis.soal.create', $item->id) }}"
                                            class="inline-block bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                            + Tambah Soal
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="border px-4 py-4 text-center text-gray-500">
                                        Belum ada data kuis.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    Kuis Siswa
                </h1>

                <p class="text-gray-600 mb-6">
                    Halaman ini digunakan siswa untuk melihat daftar kuis yang tersedia.
                </p>

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
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kuis as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2 font-semibold">{{ $item->judul }}</td>
                                    <td class="border px-4 py-2">{{ $item->deskripsi }}</td>
                                    <td class="border px-4 py-2">{{ $item->waktu_mulai }}</td>
                                    <td class="border px-4 py-2">{{ $item->waktu_selesai }}</td>
                                    <td class="border px-4 py-2">{{ $item->soal->count() }} soal</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border px-4 py-4 text-center text-gray-500">
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
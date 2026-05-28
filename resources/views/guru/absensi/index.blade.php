<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    Absensi Guru
                </h1>

                <p class="text-gray-600 mb-6">
                    Halaman ini digunakan guru untuk membuat dan melihat rekap absensi siswa.
                </p>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">No</th>
                                <th class="border px-4 py-2 text-left">Siswa ID</th>
                                <th class="border px-4 py-2 text-left">Guru ID</th>
                                <th class="border px-4 py-2 text-left">Tanggal</th>
                                <th class="border px-4 py-2 text-left">Status</th>
                                <th class="border px-4 py-2 text-left">Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($absensi as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2">{{ $item->siswa_id }}</td>
                                    <td class="border px-4 py-2">{{ $item->guru_id }}</td>
                                    <td class="border px-4 py-2">{{ $item->tanggal }}</td>
                                    <td class="border px-4 py-2 font-semibold capitalize">{{ $item->status }}</td>
                                    <td class="border px-4 py-2">{{ $item->keterangan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border px-4 py-4 text-center text-gray-500">
                                        Belum ada data absensi.
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
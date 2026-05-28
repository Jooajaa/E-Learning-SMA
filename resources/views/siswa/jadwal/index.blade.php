<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    Jadwal Siswa
                </h1>

                <p class="text-gray-600 mb-6">
                    Halaman ini digunakan siswa untuk melihat jadwal pelajaran mingguan.
                </p>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">No</th>
                                <th class="border px-4 py-2 text-left">Hari</th>
                                <th class="border px-4 py-2 text-left">Jam Mulai</th>
                                <th class="border px-4 py-2 text-left">Jam Selesai</th>
                                <th class="border px-4 py-2 text-left">Mata Pelajaran</th>
                                <th class="border px-4 py-2 text-left">Kelas</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($jadwal as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2 font-semibold">{{ $item->hari }}</td>
                                    <td class="border px-4 py-2">{{ $item->jam_mulai }}</td>
                                    <td class="border px-4 py-2">{{ $item->jam_selesai }}</td>
                                    <td class="border px-4 py-2">{{ $item->mata_pelajaran }}</td>
                                    <td class="border px-4 py-2">{{ $item->kelas }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border px-4 py-4 text-center text-gray-500">
                                        Belum ada data jadwal.
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
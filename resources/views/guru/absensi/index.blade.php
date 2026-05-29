<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Absensi Guru
                </h1>
                <p class="text-gray-500 mt-1">
                    Lihat rekap kehadiran siswa berdasarkan data absensi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($absensi as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-bold text-gray-800">
                                Siswa ID: {{ $item->siswa_id }}
                            </h2>

                            <span class="px-3 py-1 rounded-full text-sm font-bold capitalize
                                @if ($item->status == 'hadir') bg-green-100 text-green-700
                                @elseif ($item->status == 'izin') bg-blue-100 text-blue-700
                                @elseif ($item->status == 'sakit') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700
                                @endif">
                                {{ $item->status }}
                            </span>
                        </div>

                        <div class="space-y-2 text-sm text-gray-600">
                            <p>
                                <span class="font-semibold">Guru ID:</span>
                                {{ $item->guru_id ?? '-' }}
                            </p>

                            <p>
                                <span class="font-semibold">Tanggal:</span>
                                {{ $item->tanggal }}
                            </p>

                            <p>
                                <span class="font-semibold">Keterangan:</span>
                                {{ $item->keterangan ?? 'Tidak ada keterangan.' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-gray-500">
                            Belum ada data absensi.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
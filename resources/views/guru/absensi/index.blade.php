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
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $item->siswa->name ?? 'Siswa ID: ' . $item->siswa_id }}
                                </h2>

                                <p class="text-sm text-gray-500 mt-1">
                                    Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </p>
                            </div>

                            <span class="px-3 py-1 text-xs rounded-full font-semibold
                                @if ($item->status == 'Hadir') bg-green-100 text-green-700
                                @elseif ($item->status == 'Izin') bg-blue-100 text-blue-700
                                @elseif ($item->status == 'Sakit') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700
                                @endif">
                                {{ $item->status }}
                            </span>
                        </div>

                        <div class="space-y-2 text-sm text-gray-600">
                            <p>
                                <span class="font-semibold">Siswa ID:</span>
                                {{ $item->siswa_id }}
                            </p>

                            <p>
                                <span class="font-semibold">Guru ID:</span>
                                {{ $item->guru_id ?? '-' }}
                            </p>

                            <p>
                                <span class="font-semibold">Keterangan:</span>
                                {{ $item->keterangan ?? '-' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-gray-500">
                            Belum ada data absensi siswa.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
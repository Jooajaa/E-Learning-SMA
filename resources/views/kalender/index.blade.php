<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Kalender Akademik
                </h1>
                <p class="text-gray-500 mt-1">
                    Informasi kegiatan sekolah seperti ujian, libur, dan event akademik.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($kalender as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $item->judul }}
                                </h2>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $item->tanggal_mulai }}
                                    @if ($item->tanggal_selesai)
                                        - {{ $item->tanggal_selesai }}
                                    @endif
                                </p>
                            </div>

                            <span class="px-3 py-1 rounded-full text-sm font-bold capitalize
                                @if ($item->jenis == 'libur') bg-red-100 text-red-700
                                @elseif ($item->jenis == 'ujian') bg-yellow-100 text-yellow-700
                                @else bg-blue-100 text-blue-700
                                @endif">
                                {{ $item->jenis }}
                            </span>
                        </div>

                        <p class="text-gray-600">
                            {{ $item->keterangan ?? 'Tidak ada keterangan.' }}
                        </p>
                    </div>
                @empty
                    <div class="col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-gray-500">
                            Belum ada data kalender akademik.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
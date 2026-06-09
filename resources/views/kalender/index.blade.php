<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Kalender Akademik
                </h1>
                <p class="text-gray-500 mt-1">
                    Informasi kegiatan sekolah, ujian, libur akademik, dan libur nasional.
                </p>
            </div>

            <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Kegiatan Akademik</p>
                    <p class="text-3xl font-bold text-blue-700 mt-1">
                        {{ $kalender->count() }}
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Libur Nasional API</p>
                    <p class="text-3xl font-bold text-red-600 mt-1">
                        {{ $liburNasional->count() }}
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Tahun Kalender</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ $tahun ?? date('Y') }}
                    </p>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">
                    Kalender dari Sekolah
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($kalender as $item)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">
                                        {{ $item->judul ?? $item->nama_kegiatan ?? 'Kegiatan Akademik' }}
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $item->tanggal_mulai ?? $item->tanggal ?? '-' }}

                                        @if (!empty($item->tanggal_selesai))
                                            - {{ $item->tanggal_selesai }}
                                        @endif
                                    </p>
                                </div>

                                <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                                    {{ $item->tipe ?? 'Akademik' }}
                                </span>
                            </div>

                            <p class="text-gray-600">
                                {{ $item->deskripsi ?? $item->keterangan ?? '-' }}
                            </p>
                        </div>
                    @empty
                        <div class="col-span-2 bg-white rounded-xl border border-gray-200 p-8 text-center text-gray-500">
                            Belum ada kegiatan akademik dari sekolah.
                        </div>
                    @endforelse
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Libur Nasional Otomatis dari API
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Data ini diambil dari API eksternal api-hari-libur.vercel.app.
                        </p>
                    </div>

                    <span class="px-4 py-2 rounded-xl bg-blue-100 text-blue-700 text-sm font-bold">
                        Tahun {{ $tahun ?? date('Y') }}
                    </span>
                </div>

                @if (!empty($apiError))
                    <div class="mb-5 bg-red-100 border border-red-300 text-red-700 rounded-xl p-4">
                        {{ $apiError }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($liburNasional as $item)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">
                                        {{ $item['nama'] }}
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ \Carbon\Carbon::parse($item['tanggal'])->format('d M Y') }}
                                    </p>
                                </div>

                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700 font-semibold">
                                    API
                                </span>
                            </div>

                            <p class="text-gray-600">
                                Data hari libur nasional ini diambil otomatis dari API eksternal.
                            </p>
                        </div>
                    @empty
                        <div class="col-span-2 bg-white rounded-xl border border-gray-200 p-8 text-center text-gray-500">
                            Data libur nasional dari API belum tersedia.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
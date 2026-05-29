<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Kuis Siswa
                </h1>
                <p class="text-gray-500 mt-1">
                    Pilih kuis yang tersedia dan kerjakan sesuai jadwal.
                </p>
            </div>

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($kuis as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $item->judul }}
                                </h2>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $item->soal->count() }} soal
                                </p>
                            </div>

                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold">
                                Kuis
                            </span>
                        </div>

                        <p class="text-gray-600 mb-4">
                            {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
                        </p>

                        <div class="space-y-2 text-sm text-gray-600 mb-5">
                            <p>
                                <span class="font-semibold">Mulai:</span>
                                {{ $item->waktu_mulai ?? '-' }}
                            </p>

                            <p>
                                <span class="font-semibold">Selesai:</span>
                                {{ $item->waktu_selesai ?? '-' }}
                            </p>
                        </div>

                        @if ($item->soal->count() > 0)
                            <a href="{{ route('siswa.kuis.kerjakan', $item->id) }}"
                                class="inline-block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                Kerjakan Kuis
                            </a>
                        @else
                            <span class="inline-block w-full text-center bg-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-lg">
                                Belum Ada Soal
                            </span>
                        @endif
                    </div>
                @empty
                    <div class="col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-gray-500">
                            Belum ada kuis yang tersedia.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
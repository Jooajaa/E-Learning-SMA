<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Pengumpulan Tugas
                </h1>
                <p class="text-gray-500 mt-1">
                    Lihat file tugas yang dikumpulkan siswa dan berikan nilai.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse ($pengumpulan as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">

                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $item->tugas->judul ?? 'Tugas tidak ditemukan' }}
                                </h2>

                                <p class="text-sm text-gray-500 mt-1">
                                    Siswa: {{ $item->siswa->name ?? 'Siswa tidak ditemukan' }}
                                </p>
                            </div>

                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold">
                                {{ $item->status ?? 'Dikumpulkan' }}
                            </span>
                        </div>

                        <div class="space-y-2 text-sm text-gray-600 mb-5">
                            <p>
                                <span class="font-semibold">Tanggal Kumpul:</span>
                                {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                            </p>

                            <p>
                                <span class="font-semibold">Nilai Saat Ini:</span>
                                @if (!is_null($item->nilai))
                                    <span class="font-bold text-green-700">{{ $item->nilai }}</span>
                                @else
                                    <span class="text-red-600">Belum dinilai</span>
                                @endif
                            </p>

                            <p>
                                <span class="font-semibold">Komentar:</span>
                                {{ $item->komentar ?? '-' }}
                            </p>
                        </div>

                        <div class="mb-5">
                            @if ($item->file)
                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                    class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                    Lihat / Download File
                                </a>
                            @else
                                <span class="inline-block bg-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-lg">
                                    Tidak Ada File
                                </span>
                            @endif
                        </div>

                        @if (is_null($item->nilai))
                            <div class="border-t pt-4">
                                <h3 class="font-bold text-gray-800 mb-3">
                                    Beri Nilai
                                </h3>

                                <form action="{{ route('guru.pengumpulan.nilai', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Nilai
                                        </label>

                                        <input type="number" name="nilai" min="0" max="100"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Masukkan nilai 0 - 100"
                                            required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Komentar
                                        </label>

                                        <textarea name="komentar" rows="3"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Masukkan komentar untuk siswa">{{ old('komentar', $item->komentar) }}</textarea>
                                    </div>

                                    <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                        Simpan Nilai
                                    </button>
                                </form>
                            </div>
                        @else
                            <details class="border-t pt-4">
                                <summary class="cursor-pointer inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-lg transition">
                                    Edit Nilai
                                </summary>

                                <form action="{{ route('guru.pengumpulan.nilai', $item->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Nilai
                                        </label>

                                        <input type="number" name="nilai" min="0" max="100"
                                            value="{{ old('nilai', $item->nilai) }}"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Komentar
                                        </label>

                                        <textarea name="komentar" rows="3"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('komentar', $item->komentar) }}</textarea>
                                    </div>

                                    <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                        Update Nilai
                                    </button>
                                </form>
                            </details>
                        @endif

                    </div>
                @empty
                    <div class="col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-gray-500">
                            Belum ada siswa yang mengumpulkan tugas.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
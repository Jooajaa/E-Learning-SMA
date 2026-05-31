<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            {{ $kuis->judul }}
                        </h1>

                        <p class="text-gray-500 mt-2">
                            {{ $kuis->deskripsi ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>

                    <a href="{{ route('guru.kuis.index') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                        Kembali
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Waktu Mulai</p>
                        <p class="font-semibold text-gray-800">{{ $kuis->waktu_mulai }}</p>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Waktu Selesai</p>
                        <p class="font-semibold text-gray-800">{{ $kuis->waktu_selesai }}</p>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Jumlah Soal</p>
                        <p class="font-semibold text-gray-800">{{ $kuis->soal->count() }} soal</p>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('guru.kuis.soal.create', $kuis->id) }}"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                        + Tambah Soal
                    </a>
                </div>
            </div>

            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800">
                    Daftar Soal
                </h2>
                <p class="text-gray-500 mt-1">
                    Berikut daftar soal pilihan ganda pada kuis ini.
                </p>
            </div>

            <div class="space-y-4">
                @forelse ($kuis->soal as $soal)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800">
                                Soal {{ $loop->iteration }}
                            </h3>

                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold">
                                Jawaban: {{ $soal->jawaban_benar }}
                            </span>
                        </div>

                        <p class="text-gray-800 font-semibold mb-4">
                            {{ $soal->pertanyaan }}
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                            <div class="border rounded-lg p-3 {{ $soal->jawaban_benar == 'A' ? 'bg-green-100 border-green-300 text-green-800' : 'bg-gray-50 border-gray-200 text-gray-700' }}">
                                <span class="font-bold">A.</span> {{ $soal->pilihan_a }}
                            </div>

                            <div class="border rounded-lg p-3 {{ $soal->jawaban_benar == 'B' ? 'bg-green-100 border-green-300 text-green-800' : 'bg-gray-50 border-gray-200 text-gray-700' }}">
                                <span class="font-bold">B.</span> {{ $soal->pilihan_b }}
                            </div>

                            <div class="border rounded-lg p-3 {{ $soal->jawaban_benar == 'C' ? 'bg-green-100 border-green-300 text-green-800' : 'bg-gray-50 border-gray-200 text-gray-700' }}">
                                <span class="font-bold">C.</span> {{ $soal->pilihan_c }}
                            </div>

                            <div class="border rounded-lg p-3 {{ $soal->jawaban_benar == 'D' ? 'bg-green-100 border-green-300 text-green-800' : 'bg-gray-50 border-gray-200 text-gray-700' }}">
                                <span class="font-bold">D.</span> {{ $soal->pilihan_d }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-gray-500 mb-4">
                            Belum ada soal untuk kuis ini.
                        </p>

                        <a href="{{ route('guru.kuis.soal.create', $kuis->id) }}"
                            class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg">
                            + Tambah Soal Pertama
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Kerjakan Kuis
                </h1>
                <p class="text-gray-500 mt-1">
                    Pilih jawaban yang menurut kamu paling benar.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ $kuis->judul }}
                </h2>

                <p class="text-gray-600 mt-2">
                    {{ $kuis->deskripsi ?? 'Tidak ada deskripsi.' }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-5 text-sm">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <p class="text-gray-500">Jumlah Soal</p>
                        <p class="font-bold text-blue-700 mt-1">
                            {{ $kuis->soal->count() }} soal
                        </p>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-gray-500">Waktu Mulai</p>
                        <p class="font-bold text-green-700 mt-1">
                            {{ $kuis->waktu_mulai ? \Carbon\Carbon::parse($kuis->waktu_mulai)->format('d-m-Y H:i') : '-' }}
                        </p>
                    </div>

                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <p class="text-gray-500">Waktu Selesai</p>
                        <p class="font-bold text-red-700 mt-1">
                            {{ $kuis->waktu_selesai ? \Carbon\Carbon::parse($kuis->waktu_selesai)->format('d-m-Y H:i') : '-' }}
                        </p>
                    </div>
                </div>
            </div>

            @if ($kuis->soal->isEmpty())
                <div class="bg-white border border-gray-200 rounded-xl p-6 text-center text-gray-500">
                    Kuis ini belum memiliki soal.
                </div>
            @else
                <form action="{{ route('siswa.kuis.submit', $kuis->id) }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        @foreach ($kuis->soal as $soal)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">
                                    Soal {{ $loop->iteration }}
                                </h3>

                                <p class="text-gray-800 font-semibold mb-5">
                                    {{ $soal->pertanyaan }}
                                </p>

                                <div class="space-y-3">
                                    <label class="flex items-start gap-3 border border-gray-200 rounded-lg p-3 cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="jawaban[{{ $soal->id }}]" value="A"
                                            class="mt-1 text-blue-600 focus:ring-blue-500" required>
                                        <span>
                                            <span class="font-bold">A.</span>
                                            {{ $soal->pilihan_a }}
                                        </span>
                                    </label>

                                    <label class="flex items-start gap-3 border border-gray-200 rounded-lg p-3 cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="jawaban[{{ $soal->id }}]" value="B"
                                            class="mt-1 text-blue-600 focus:ring-blue-500" required>
                                        <span>
                                            <span class="font-bold">B.</span>
                                            {{ $soal->pilihan_b }}
                                        </span>
                                    </label>

                                    <label class="flex items-start gap-3 border border-gray-200 rounded-lg p-3 cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="jawaban[{{ $soal->id }}]" value="C"
                                            class="mt-1 text-blue-600 focus:ring-blue-500" required>
                                        <span>
                                            <span class="font-bold">C.</span>
                                            {{ $soal->pilihan_c }}
                                        </span>
                                    </label>

                                    <label class="flex items-start gap-3 border border-gray-200 rounded-lg p-3 cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="jawaban[{{ $soal->id }}]" value="D"
                                            class="mt-1 text-blue-600 focus:ring-blue-500" required>
                                        <span>
                                            <span class="font-bold">D.</span>
                                            {{ $soal->pilihan_d }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <button type="submit"
                            onclick="return confirm('Yakin ingin mengumpulkan kuis ini? Setelah dikumpulkan, kuis tidak bisa dikerjakan ulang.')"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-sm transition">
                            Kumpulkan Kuis
                        </button>

                        <a href="{{ route('siswa.kuis.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition">
                            Kembali
                        </a>
                    </div>
                </form>
            @endif

        </div>
    </div>
</x-app-layout>
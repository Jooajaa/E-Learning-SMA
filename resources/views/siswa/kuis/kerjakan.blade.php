<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    Kerjakan Kuis
                </h1>

                <p class="text-gray-600 mb-6">
                    Kuis: <span class="font-semibold">{{ $kuis->judul }}</span>
                </p>

                <form action="{{ route('siswa.kuis.submit', $kuis->id) }}" method="POST">
                    @csrf

                    @forelse ($kuis->soal as $soal)
                        <div class="mb-6 p-4 border rounded-lg">
                            <p class="font-semibold text-gray-800 mb-3">
                                {{ $loop->iteration }}. {{ $soal->pertanyaan }}
                            </p>

                            <label class="block mb-2">
                                <input type="radio" name="jawaban_{{ $soal->id }}" value="A" required>
                                A. {{ $soal->pilihan_a }}
                            </label>

                            <label class="block mb-2">
                                <input type="radio" name="jawaban_{{ $soal->id }}" value="B">
                                B. {{ $soal->pilihan_b }}
                            </label>

                            <label class="block mb-2">
                                <input type="radio" name="jawaban_{{ $soal->id }}" value="C">
                                C. {{ $soal->pilihan_c }}
                            </label>

                            <label class="block mb-2">
                                <input type="radio" name="jawaban_{{ $soal->id }}" value="D">
                                D. {{ $soal->pilihan_d }}
                            </label>
                        </div>
                    @empty
                        <p class="text-gray-500">
                            Belum ada soal pada kuis ini.
                        </p>
                    @endforelse

                    @if ($kuis->soal->count() > 0)
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg">
                            Kumpulkan Jawaban
                        </button>
                    @endif

                    <a href="{{ route('siswa.kuis.index') }}"
                        class="ml-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-lg">
                        Kembali
                    </a>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
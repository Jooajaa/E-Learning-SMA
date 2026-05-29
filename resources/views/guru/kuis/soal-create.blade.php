<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Tambah Soal Kuis
                </h1>

                <p class="text-gray-500 mt-1">
                    Tambahkan soal pilihan ganda untuk kuis:
                    <span class="font-semibold text-gray-700">
                        {{ $kuis->judul }}
                    </span>
                </p>
            </div>

            <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('guru.kuis.soal.store', $kuis->id) }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Pertanyaan
                        </label>

                        <textarea name="pertanyaan" rows="4"
                            placeholder="Contoh: Apa ibu kota Indonesia?"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>{{ old('pertanyaan') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Pilihan A
                            </label>

                            <input type="text" name="pilihan_a" value="{{ old('pilihan_a') }}"
                                placeholder="Masukkan pilihan A"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Pilihan B
                            </label>

                            <input type="text" name="pilihan_b" value="{{ old('pilihan_b') }}"
                                placeholder="Masukkan pilihan B"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Pilihan C
                            </label>

                            <input type="text" name="pilihan_c" value="{{ old('pilihan_c') }}"
                                placeholder="Masukkan pilihan C"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Pilihan D
                            </label>

                            <input type="text" name="pilihan_d" value="{{ old('pilihan_d') }}"
                                placeholder="Masukkan pilihan D"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Jawaban Benar
                        </label>

                        <select name="jawaban_benar"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                            <option value="">-- Pilih Jawaban Benar --</option>
                            <option value="A" {{ old('jawaban_benar') == 'A' ? 'selected' : '' }}>
                                A
                            </option>
                            <option value="B" {{ old('jawaban_benar') == 'B' ? 'selected' : '' }}>
                                B
                            </option>
                            <option value="C" {{ old('jawaban_benar') == 'C' ? 'selected' : '' }}>
                                C
                            </option>
                            <option value="D" {{ old('jawaban_benar') == 'D' ? 'selected' : '' }}>
                                D
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-sm transition">
                            Simpan Soal
                        </button>

                        <a href="{{ route('guru.kuis.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 py-2 rounded-lg transition">
                            Batal
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    Tambah Soal Kuis
                </h1>

                <p class="text-gray-600 mb-6">
                    Kuis: <span class="font-semibold">{{ $kuis->judul }}</span>
                </p>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('guru.kuis.soal.store', $kuis->id) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Pertanyaan
                        </label>

                        <textarea name="pertanyaan" rows="4"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>{{ old('pertanyaan') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Pilihan A
                            </label>

                            <input type="text" name="pilihan_a" value="{{ old('pilihan_a') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Pilihan B
                            </label>

                            <input type="text" name="pilihan_b" value="{{ old('pilihan_b') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Pilihan C
                            </label>

                            <input type="text" name="pilihan_c" value="{{ old('pilihan_c') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Pilihan D
                            </label>

                            <input type="text" name="pilihan_d" value="{{ old('pilihan_d') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Jawaban Benar
                        </label>

                        <select name="jawaban_benar"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                            <option value="">-- Pilih Jawaban Benar --</option>
                            <option value="A" {{ old('jawaban_benar') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('jawaban_benar') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ old('jawaban_benar') == 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ old('jawaban_benar') == 'D' ? 'selected' : '' }}>D</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg">
                            Simpan Soal
                        </button>

                        <a href="{{ route('guru.kuis.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-lg">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
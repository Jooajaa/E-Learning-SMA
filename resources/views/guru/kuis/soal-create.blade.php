<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="mb-6">
                <h1 class="text-3xl font-extrabold text-slate-800">Tambah Soal Kuis</h1>
                <p class="text-slate-500 mt-1">
                    Tambahkan soal pilihan ganda untuk kuis:
                    <span class="font-bold text-blue-700">{{ $kuis->judul }}</span>
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-2xl">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('guru.kuis.soal.store', $kuis->id) }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Pertanyaan</label>
                        <textarea name="pertanyaan" rows="4"
                            placeholder="Tulis pertanyaan soal"
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>{{ old('pertanyaan') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Pilihan A</label>
                            <input type="text" name="pilihan_a" value="{{ old('pilihan_a') }}"
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Pilihan B</label>
                            <input type="text" name="pilihan_b" value="{{ old('pilihan_b') }}"
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Pilihan C</label>
                            <input type="text" name="pilihan_c" value="{{ old('pilihan_c') }}"
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Pilihan D</label>
                            <input type="text" name="pilihan_d" value="{{ old('pilihan_d') }}"
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Jawaban Benar</label>
                        <select name="jawaban_benar"
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                            <option value="">-- Pilih Jawaban Benar --</option>
                            @foreach (['A', 'B', 'C', 'D'] as $opsi)
                                <option value="{{ $opsi }}" {{ old('jawaban_benar') == $opsi ? 'selected' : '' }}>
                                    {{ $opsi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-wrap gap-3 pt-2">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl transition">
                            Simpan Soal
                        </button>

                        <a href="{{ route('guru.kuis.show', $kuis->id) }}"
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-6 py-3 rounded-xl transition">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
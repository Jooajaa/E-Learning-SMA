<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- HEADER --}}
            <div class="bg-gradient-to-r from-purple-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-purple-100 font-semibold mb-2">
                            Koreksi Tugas
                        </p>

                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Pengumpulan Tugas
                        </h1>

                        <p class="text-purple-100 mt-3">
                            Periksa file jawaban siswa, berikan nilai, dan tuliskan komentar penilaian.
                        </p>

                        @if (isset($guruKelas) && $guruKelas)
                            <div class="mt-5 inline-flex flex-wrap items-center gap-2 bg-white/15 border border-white/20 px-4 py-2 rounded-xl">
                                <span class="text-purple-100 text-sm">Kelas:</span>
                                <span class="font-bold">
                                    {{ $guruKelas->kelas->nama_kelas ?? '-' }}
                                </span>

                                <span class="text-purple-100 text-sm ml-3">Mapel:</span>
                                <span class="font-bold">
                                    {{ $guruKelas->mataPelajaran->nama_mapel ?? $guruKelas->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col md:items-end gap-3">
                        <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[180px]">
                            <p class="text-purple-100 text-sm">
                                Total Pengumpulan
                            </p>

                            <p class="text-3xl font-extrabold mt-1">
                                {{ isset($pengumpulan) ? $pengumpulan->count() : 0 }}
                            </p>
                        </div>

                        @if (isset($guruKelas) && $guruKelas)
                            <a href="{{ route('guru.mapel.show', $guruKelas->id) }}"
                               class="bg-white/15 hover:bg-white/25 border border-white/20 text-white font-bold px-5 py-3 rounded-xl transition">
                                Kembali
                            </a>
                        @else
                            <a href="{{ route('guru.dashboard') }}"
                               class="bg-white/15 hover:bg-white/25 border border-white/20 text-white font-bold px-5 py-3 rounded-xl transition">
                                Kembali
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ALERT --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-2xl">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-2xl">
                    <p class="font-bold mb-2">Terjadi kesalahan:</p>

                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- LIST PENGUMPULAN --}}
            @if (!isset($pengumpulan) || $pengumpulan->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada pengumpulan tugas untuk kelas dan mata pelajaran ini.
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach ($pengumpulan as $item)
                        @php
                            $status = strtolower($item->status ?? 'dikumpulkan');
                        @endphp

                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                            {{-- BAGIAN ATAS CARD --}}
                            <div class="flex items-start justify-between gap-4 mb-5">
                                <div>
                                    <p class="text-sm text-slate-500">
                                        Tugas
                                    </p>

                                    <h3 class="text-xl font-extrabold text-slate-800 mt-1">
                                        {{ $item->tugas->judul ?? '-' }}
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-2">
                                        Siswa:
                                        <span class="font-semibold text-blue-700">
                                            {{ $item->siswa->name ?? '-' }}
                                        </span>
                                    </p>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Mapel:
                                        <span class="font-semibold text-slate-700">
                                            {{ $item->tugas->mataPelajaran->nama_mapel ?? $item->tugas->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                        </span>
                                    </p>
                                </div>

                                @if ($status == 'dinilai')
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                        Dinilai
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                        Dikumpulkan
                                    </span>
                                @endif
                            </div>

                            {{-- INFORMASI --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-5">
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-sm text-slate-500">
                                        Kelas
                                    </p>

                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->tugas->kelas->nama_kelas ?? '-' }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-sm text-slate-500">
                                        Tanggal Kumpul
                                    </p>

                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                                    </p>
                                </div>
                            </div>

                            {{-- KOMENTAR SISWA --}}
                            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 mb-4">
                                <p class="text-sm text-slate-500">
                                    Komentar Siswa
                                </p>

                                <p class="font-semibold text-slate-800 mt-1">
                                    {{ $item->komentar_siswa ?? '-' }}
                                </p>
                            </div>

                            {{-- KOMENTAR GURU --}}
                            <div class="bg-purple-50 border border-purple-200 rounded-xl p-3 mb-5">
                                <p class="text-sm text-purple-600">
                                    Komentar Guru
                                </p>

                                <p class="font-semibold text-slate-800 mt-1">
                                    {{ $item->komentar_guru ?? 'Belum ada komentar guru.' }}
                                </p>
                            </div>

                            {{-- NILAI --}}
                            <div class="bg-green-50 border border-green-200 rounded-xl p-3 mb-5">
                                <p class="text-sm text-green-600">
                                    Nilai
                                </p>

                                <p class="font-extrabold text-slate-800 mt-1 text-xl">
                                    {{ $item->nilai ?? 'Belum dinilai' }}
                                </p>
                            </div>

                            {{-- FILE JAWABAN --}}
                            @if ($item->file)
                                <a href="{{ asset('storage/' . $item->file) }}"
                                   target="_blank"
                                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl transition mb-5">
                                    Lihat / Download Jawaban
                                </a>
                            @else
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-slate-500 mb-5">
                                    Tidak ada file jawaban.
                                </div>
                            @endif

                            {{-- FORM NILAI --}}
                            <form action="{{ route('guru.pengumpulan.nilai', $item->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                @if (isset($guruKelasId) && $guruKelasId)
                                    <input type="hidden" name="guru_kelas_id" value="{{ $guruKelasId }}">
                                @endif

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Nilai
                                    </label>

                                    <input type="number"
                                           name="nilai"
                                           min="0"
                                           max="100"
                                           value="{{ old('nilai', $item->nilai) }}"
                                           placeholder="Contoh: 90"
                                           class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Komentar Guru
                                    </label>

                                    <textarea name="komentar_guru"
                                              rows="4"
                                              placeholder="Tulis komentar penilaian"
                                              class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('komentar_guru', $item->komentar_guru) }}</textarea>
                                </div>

                                <button type="submit"
                                        class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold px-5 py-3 rounded-xl transition">
                                    Simpan Nilai dan Komentar
                                </button>
                            </form>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
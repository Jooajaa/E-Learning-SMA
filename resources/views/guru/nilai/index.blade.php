<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-red-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-red-100 font-semibold mb-2">
                            Rekap Evaluasi
                        </p>

                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Nilai Siswa
                        </h1>

                        <p class="text-red-100 mt-3">
                            Lihat nilai kuis dan tugas siswa berdasarkan kelas dan mata pelajaran yang kamu ajar.
                        </p>

                        @if (isset($guruKelas) && $guruKelas)
                            <div class="mt-5 inline-flex items-center gap-2 bg-white/15 border border-white/20 px-4 py-2 rounded-xl">
                                <span class="text-red-100 text-sm">Kelas:</span>
                                <span class="font-bold">
                                    {{ $guruKelas->kelas->nama_kelas ?? '-' }}
                                </span>

                                <span class="text-red-100 text-sm ml-3">Mapel:</span>
                                <span class="font-bold">
                                    {{ $guruKelas->mataPelajaran->nama_mapel ?? $guruKelas->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                </span>
                            </div>
                        @endif
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

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- NILAI KUIS --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">
                                Nilai Kuis
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Total: {{ isset($nilaiKuis) ? $nilaiKuis->count() : 0 }} data
                            </p>
                        </div>
                    </div>

                    @if (!isset($nilaiKuis) || $nilaiKuis->isEmpty())
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 text-center text-slate-500">
                            Belum ada nilai kuis.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($nilaiKuis as $item)
                                @php
                                    $nilai = $item->nilai ?? 0;
                                @endphp

                                <div class="border border-slate-200 rounded-2xl p-5 hover:shadow-sm transition">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="text-sm text-slate-500">
                                                Nama Siswa
                                            </p>

                                            <h3 class="text-xl font-extrabold text-slate-800">
                                                {{ $item->siswa->name ?? '-' }}
                                            </h3>

                                            <p class="text-sm text-slate-500 mt-2">
                                                Kuis:
                                                <span class="font-semibold text-slate-700">
                                                    {{ $item->kuis->judul ?? '-' }}
                                                </span>
                                            </p>

                                            <p class="text-sm text-slate-500 mt-1">
                                                Mapel:
                                                <span class="font-semibold text-slate-700">
                                                    {{ $item->mataPelajaran->nama_mapel ?? $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                                </span>
                                            </p>

                                            <p class="text-sm text-slate-500 mt-1">
                                                Keterangan:
                                                <span class="font-semibold text-slate-700">
                                                    {{ $item->keterangan ?? '-' }}
                                                </span>
                                            </p>
                                        </div>

                                        @if ($nilai >= 80)
                                            <span class="px-4 py-2 rounded-xl bg-green-100 text-green-700 font-extrabold">
                                                {{ $nilai }}
                                            </span>
                                        @elseif ($nilai >= 60)
                                            <span class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 font-extrabold">
                                                {{ $nilai }}
                                            </span>
                                        @else
                                            <span class="px-4 py-2 rounded-xl bg-red-100 text-red-700 font-extrabold">
                                                {{ $nilai }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- NILAI TUGAS --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">
                                Nilai Tugas
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Total: {{ isset($nilaiTugas) ? $nilaiTugas->count() : 0 }} data
                            </p>
                        </div>
                    </div>

                    @if (!isset($nilaiTugas) || $nilaiTugas->isEmpty())
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 text-center text-slate-500">
                            Belum ada nilai tugas.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($nilaiTugas as $item)
                                @php
                                    $nilai = $item->nilai ?? 0;
                                @endphp

                                <div class="border border-slate-200 rounded-2xl p-5 hover:shadow-sm transition">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="text-sm text-slate-500">
                                                Nama Siswa
                                            </p>

                                            <h3 class="text-xl font-extrabold text-slate-800">
                                                {{ $item->siswa->name ?? '-' }}
                                            </h3>

                                            <p class="text-sm text-slate-500 mt-2">
                                                Tugas:
                                                <span class="font-semibold text-slate-700">
                                                    {{ $item->tugas->judul ?? '-' }}
                                                </span>
                                            </p>

                                            <p class="text-sm text-slate-500 mt-1">
                                                Mapel:
                                                <span class="font-semibold text-slate-700">
                                                    {{ $item->mataPelajaran->nama_mapel ?? $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                                </span>
                                            </p>

                                            <p class="text-sm text-slate-500 mt-1">
                                                Keterangan:
                                                <span class="font-semibold text-slate-700">
                                                    {{ $item->keterangan ?? '-' }}
                                                </span>
                                            </p>
                                        </div>

                                        @if ($nilai >= 80)
                                            <span class="px-4 py-2 rounded-xl bg-green-100 text-green-700 font-extrabold">
                                                {{ $nilai }}
                                            </span>
                                        @elseif ($nilai >= 60)
                                            <span class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 font-extrabold">
                                                {{ $nilai }}
                                            </span>
                                        @else
                                            <span class="px-4 py-2 rounded-xl bg-red-100 text-red-700 font-extrabold">
                                                {{ $nilai }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
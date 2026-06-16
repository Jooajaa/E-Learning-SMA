<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-green-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-green-100 font-semibold mb-2">
                            Aktivitas Belajar
                        </p>

                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Tugas Siswa
                        </h1>

                        <p class="text-green-100 mt-3">
                            Kerjakan tugas dari guru sesuai kelas dan mata pelajaran yang kamu pilih.
                        </p>

                        @if (isset($mapel) && $mapel)
                            <div class="mt-5 inline-flex items-center gap-2 bg-white/15 border border-white/20 px-4 py-2 rounded-xl">
                                <span class="text-green-100 text-sm">Mata Pelajaran:</span>
                                <span class="font-bold">
                                    {{ $mapel->nama_mapel ?? $mapel->nama_mata_pelajaran ?? '-' }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col md:items-end gap-3">
                        <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[180px]">
                            <p class="text-green-100 text-sm">
                                Total Tugas
                            </p>

                            <p class="text-3xl font-extrabold mt-1">
                                {{ isset($tugas) ? $tugas->count() : 0 }}
                            </p>
                        </div>

                        @if (isset($mataPelajaranId) && $mataPelajaranId)
                            <a href="{{ route('siswa.mapel.show', $mataPelajaranId) }}"
                               class="bg-white/15 hover:bg-white/25 border border-white/20 text-white font-bold px-5 py-3 rounded-xl transition">
                                Kembali
                            </a>
                        @else
                            <a href="{{ route('siswa.dashboard') }}"
                               class="bg-white/15 hover:bg-white/25 border border-white/20 text-white font-bold px-5 py-3 rounded-xl transition">
                                Kembali
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Alert --}}
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

            @if (!isset($mataPelajaranId) || !$mataPelajaranId)
                <div class="mb-6 p-4 bg-yellow-100 border border-yellow-300 text-yellow-700 rounded-2xl">
                    Halaman ini sebaiknya dibuka dari menu mata pelajaran agar tugas tampil sesuai mapel.
                    Silakan kembali ke dashboard, pilih mata pelajaran, lalu klik Tugas.
                </div>
            @endif

            {{-- List Tugas --}}
            @if (!isset($tugas) || $tugas->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada tugas untuk mata pelajaran ini.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($tugas as $item)
                        @php
                            $pengumpulan = $pengumpulanTugas[$item->id] ?? null;
                            $targetMapelId = $mataPelajaranId ?? request('mata_pelajaran_id') ?? $item->mata_pelajaran_id;
                        @endphp

                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition">

                            <div class="flex items-start justify-between gap-4 mb-5">
                                <div>
                                    <p class="text-sm text-slate-500">
                                        Judul Tugas
                                    </p>

                                    <h3 class="text-xl font-extrabold text-slate-800 mt-1">
                                        {{ $item->judul }}
                                    </h3>
                                </div>

                                @if ($pengumpulan)
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                        Sudah Kumpul
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                        Belum Kumpul
                                    </span>
                                @endif
                            </div>

                            <p class="text-sm text-slate-500">
                                Guru:
                                <span class="font-semibold text-blue-700">
                                    {{ $item->guru->name ?? '-' }}
                                </span>
                            </p>

                            @if ($item->mataPelajaran)
                                <p class="text-sm text-slate-500 mt-1">
                                    Mapel:
                                    <span class="font-semibold text-slate-700">
                                        {{ $item->mataPelajaran->nama_mapel ?? $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                    </span>
                                </p>
                            @endif

                            <p class="text-sm text-slate-600 mt-4 line-clamp-3">
                                {{ $item->instruksi ?? '-' }}
                            </p>

                            <div class="grid grid-cols-2 gap-3 mt-5">
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-sm text-slate-500">
                                        Deadline
                                    </p>

                                    <p class="text-sm font-bold text-slate-800 mt-1">
                                        {{ $item->deadline ? \Carbon\Carbon::parse($item->deadline)->format('d-m-Y H:i') : '-' }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-sm text-slate-500">
                                        Nilai
                                    </p>

                                    <p class="text-sm font-bold text-slate-800 mt-1">
                                        @if ($pengumpulan && $pengumpulan->nilai !== null)
                                            {{ $pengumpulan->nilai }}
                                        @elseif ($pengumpulan)
                                            Belum dinilai
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if ($pengumpulan)
                                <a href="{{ route('siswa.tugas.show', $item->id) }}?mata_pelajaran_id={{ $targetMapelId }}"
                                   class="mt-5 block w-full text-center bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-3 rounded-xl transition">
                                    Lihat Pengumpulan
                                </a>
                            @else
                                <a href="{{ route('siswa.tugas.show', $item->id) }}?mata_pelajaran_id={{ $targetMapelId }}"
                                   class="mt-5 block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl transition">
                                    Kerjakan Tugas
                                </a>
                            @endif

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
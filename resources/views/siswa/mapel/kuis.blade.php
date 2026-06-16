<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- HEADER --}}
            <div class="bg-gradient-to-r from-amber-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-amber-100 font-semibold mb-2">
                            Kuis Mata Pelajaran
                        </p>

                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            {{ $mapel->nama_mapel ?? $mapel->nama_mata_pelajaran ?? 'Mata Pelajaran' }}
                        </h1>

                        <p class="text-amber-100 mt-3">
                            Kelas {{ $kelas->nama_kelas ?? '-' }}
                        </p>
                    </div>

                    <a href="{{ route('siswa.mapel.show', $mapel->id) }}"
                       class="bg-white/15 hover:bg-white/25 border border-white/20 text-white font-bold px-5 py-3 rounded-xl transition">
                        Kembali
                    </a>
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

            {{-- LIST KUIS --}}
            @if (!isset($kuis) || $kuis->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada kuis untuk mata pelajaran ini.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($kuis as $item)
                        @php
                            $sudahDikerjakan = in_array($item->id, $kuisSudahDikerjakan ?? []);
                        @endphp

                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition">

                            <div class="flex items-start justify-between gap-4 mb-5">
                                <div>
                                    <p class="text-sm text-slate-500">
                                        Judul Kuis
                                    </p>

                                    <h3 class="text-xl font-extrabold text-slate-800 mt-1">
                                        {{ $item->judul }}
                                    </h3>
                                </div>

                                @if ($sudahDikerjakan)
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                        Sudah
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                        Belum
                                    </span>
                                @endif
                            </div>

                            <p class="text-sm text-slate-500">
                                Guru:
                                <span class="font-semibold text-blue-700">
                                    {{ $item->guru->name ?? '-' }}
                                </span>
                            </p>

                            <p class="text-sm text-slate-600 mt-4 line-clamp-3">
                                {{ $item->deskripsi ?? '-' }}
                            </p>

                            <div class="grid grid-cols-2 gap-3 mt-5">
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-sm text-slate-500">
                                        Jumlah Soal
                                    </p>

                                    <p class="text-sm font-bold text-slate-800 mt-1">
                                        {{ $item->soal->count() ?? 0 }} soal
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-sm text-slate-500">
                                        Status
                                    </p>

                                    <p class="text-sm font-bold text-slate-800 mt-1">
                                        @if ($sudahDikerjakan)
                                            Sudah dikerjakan
                                        @else
                                            Belum dikerjakan
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if ($sudahDikerjakan)
                                <button disabled
                                    class="mt-5 block w-full text-center bg-slate-400 text-white font-bold px-5 py-3 rounded-xl cursor-not-allowed">
                                    Sudah Dikerjakan
                                </button>
                            @else
                                <a href="{{ route('siswa.kuis.kerjakan', $item->id) }}?mata_pelajaran_id={{ $mapel->id }}"
                                   class="mt-5 block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl transition">
                                    Kerjakan Kuis
                                </a>
                            @endif

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
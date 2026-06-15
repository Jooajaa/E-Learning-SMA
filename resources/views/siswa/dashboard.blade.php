<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-blue-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-blue-100 font-semibold mb-2">
                            Dashboard Siswa
                        </p>

                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Halo, {{ Auth::user()->name }}
                        </h1>

                        <p class="text-blue-100 mt-3 max-w-2xl">
                            Pilih mata pelajaran terlebih dahulu untuk melihat materi, tugas, kuis, nilai, dan aktivitas pembelajaran lainnya.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[200px]">
                        <p class="text-blue-100 text-sm">Kelas Kamu</p>

                        <p class="text-2xl font-extrabold mt-1">
                            {{ $kelas->nama_kelas ?? '-' }}
                        </p>

                        <p class="text-blue-100 text-sm mt-1">
                            {{ $kelas->tingkat ?? '-' }} {{ $kelas->jurusan ?? '' }}
                        </p>
                    </div>
                </div>
            </div>

            @if (!$kelas)
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Kamu belum dimasukkan ke kelas mana pun. Hubungi admin sekolah.
                </div>
            @elseif ($mapel->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada mata pelajaran untuk kelas {{ $kelas->nama_kelas }}.
                </div>
            @else
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">
                                Mata Pelajaran di Kelas Kamu
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Daftar mata pelajaran berdasarkan kelas yang kamu ikuti.
                            </p>
                        </div>

                        <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-xl font-bold text-sm">
                            Total Mapel: {{ $mapel->count() }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach ($mapel as $item)
                            <a href="{{ route('siswa.mapel.show', $item->id) }}"
                                class="border border-slate-200 bg-slate-50 rounded-2xl p-5 hover:bg-white hover:shadow-md hover:-translate-y-1 transition block">

                                <div class="flex items-start justify-between gap-3 mb-4">
                                    <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl">
                                        📘
                                    </div>

                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                        Mata Pelajaran
                                    </span>
                                </div>

                                <p class="text-sm text-slate-500">
                                    Mata Pelajaran
                                </p>

                                <h3 class="text-xl font-extrabold text-slate-800 mt-1">
                                    {{ $item->nama_mapel ?? $item->nama_mata_pelajaran ?? 'Mata Pelajaran' }}
                                </h3>

                                @if (isset($item->guru_name))
                                    <p class="text-sm text-slate-500 mt-3">
                                        Guru:
                                        <span class="font-semibold text-blue-700">
                                            {{ $item->guru_name }}
                                        </span>
                                    </p>
                                @endif

                                <div class="mt-5 bg-white border border-slate-200 rounded-xl p-3">
                                    <p class="text-sm text-slate-500">
                                        Masuk untuk melihat materi, tugas, kuis, dan nilai mata pelajaran ini.
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
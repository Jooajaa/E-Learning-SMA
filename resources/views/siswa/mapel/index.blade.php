<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-blue-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <p class="text-blue-100 font-semibold mb-2">Mata Pelajaran Saya</p>
                <h1 class="text-3xl md:text-4xl font-extrabold">Pilih Mata Pelajaran</h1>
                <p class="text-blue-100 mt-3 max-w-2xl">
                    Pilih mata pelajaran terlebih dahulu untuk melihat materi, tugas, dan kuis yang sesuai dengan kelas kamu.
                </p>
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
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">
                        Kelas {{ $kelas->nama_kelas }}
                    </h2>
                    <p class="text-slate-500 text-sm mt-1">
                        Berikut mata pelajaran yang tersedia untuk kelas kamu.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($mapel as $item)
                        <a href="{{ route('siswa.mapel.show', $item->id) }}"
                           class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition block">

                            <div class="flex items-start justify-between gap-3 mb-5">
                                <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl">
                                    📘
                                </div>

                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                    Mapel
                                </span>
                            </div>

                            <h3 class="text-xl font-extrabold text-slate-800">
                                {{ $item->nama_mapel ?? $item->nama_mata_pelajaran ?? 'Mata Pelajaran' }}
                            </h3>

                            <p class="text-slate-500 text-sm mt-2">
                                Klik untuk melihat materi, tugas, dan kuis mata pelajaran ini.
                            </p>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-blue-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-blue-100 font-semibold mb-2">
                            Kelas dan Mata Pelajaran
                        </p>

                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Daftar Mengajar
                        </h1>

                        <p class="text-blue-100 mt-3 max-w-2xl">
                            Pilih kelas dan mata pelajaran yang kamu ajar untuk mengelola materi, tugas, dan kuis.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[180px]">
                        <p class="text-blue-100 text-sm">Total Penugasan</p>
                        <p class="text-3xl font-extrabold mt-1">
                            {{ $guruKelas->count() }}
                        </p>
                    </div>
                </div>
            </div>

            @if ($guruKelas->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Kamu belum memiliki penugasan mengajar. Hubungi admin untuk mengatur kelas dan mata pelajaran.
                </div>
            @else
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">
                        Pilih Kelas dan Mata Pelajaran
                    </h2>

                    <p class="text-slate-500 text-sm mt-1">
                        Setelah memilih salah satu, kamu dapat membuat materi, tugas, dan kuis tanpa memilih kelas lagi.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($guruKelas as $item)
                        <a href="{{ route('guru.mapel.show', $item->id) }}"
                           class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition block">

                            <div class="flex items-start justify-between gap-3 mb-5">
                                <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl">
                                    👨‍🏫
                                </div>

                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                    Mengajar
                                </span>
                            </div>

                            <h3 class="text-xl font-extrabold text-slate-800">
                                {{ $item->kelas->nama_kelas ?? '-' }}
                            </h3>

                            <p class="text-slate-500 text-sm mt-2">
                                Mata Pelajaran:
                            </p>

                            <p class="text-lg font-bold text-blue-700 mt-1">
                                {{ $item->mataPelajaran->nama_mapel ?? '-' }}
                            </p>

                            <div class="mt-5 bg-slate-50 border border-slate-200 rounded-xl p-3">
                                <p class="text-sm text-slate-500">
                                    Klik untuk masuk ke ruang pembelajaran mapel ini.
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
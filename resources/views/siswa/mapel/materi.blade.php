<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-blue-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-blue-100 font-semibold mb-2">Materi Mata Pelajaran</p>

                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            {{ $mapel->nama_mapel ?? $mapel->nama_mata_pelajaran ?? 'Mata Pelajaran' }}
                        </h1>

                        <p class="text-blue-100 mt-3">
                            Kelas {{ $kelas->nama_kelas ?? '-' }}
                        </p>
                    </div>

                    <a href="{{ route('siswa.mapel.show', $mapel->id) }}"
                       class="bg-white/15 hover:bg-white/25 border border-white/20 text-white font-bold px-5 py-3 rounded-xl transition">
                        Kembali
                    </a>
                </div>
            </div>

            @if ($materi->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada materi untuk mata pelajaran ini.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($materi as $item)
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition">

                            <div class="flex items-start justify-between gap-3 mb-5">
                                <div>
                                    <p class="text-sm text-slate-500">Judul Materi</p>
                                    <h3 class="text-xl font-extrabold text-slate-800 mt-1">
                                        {{ $item->judul }}
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Guru:
                                        <span class="font-semibold text-blue-700">
                                            {{ $item->guru->name ?? '-' }}
                                        </span>
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                    Materi
                                </span>
                            </div>

                            <p class="text-sm text-slate-600 mb-5">
                                {{ \Illuminate\Support\Str::limit($item->deskripsi ?? 'Tidak ada deskripsi.', 120) }}
                            </p>

                            <div class="grid grid-cols-2 gap-3 text-sm mb-5">
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-slate-500">Kelas</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->kelas->nama_kelas ?? '-' }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-slate-500">File</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->file ? 'Ada file' : 'Tidak ada' }}
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('siswa.materi.show', $item->id) }}"
                               class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-3 rounded-xl transition">
                                Lihat Materi
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-red-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <p class="text-red-100 font-semibold mb-2">Rekap Evaluasi</p>
                <h1 class="text-3xl md:text-4xl font-extrabold">Nilai Siswa</h1>
                <p class="text-red-100 mt-3 max-w-2xl">
                    Lihat nilai kuis dan tugas dari siswa pada kelas yang kamu ajar.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">Nilai Kuis</h2>

                    @if ($nilaiKuis->isEmpty())
                        <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                            Belum ada nilai kuis.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($nilaiKuis as $item)
                                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <h3 class="font-extrabold text-slate-800 text-lg">
                                                {{ $item->siswa->name ?? 'Siswa' }}
                                            </h3>
                                            <p class="text-sm text-slate-500 mt-1">
                                                {{ $item->kuis->judul ?? '-' }}
                                            </p>
                                            <p class="text-sm text-slate-500">
                                                Kelas: {{ $item->kuis->kelas->nama_kelas ?? '-' }}
                                            </p>
                                        </div>

                                        <span class="px-4 py-2 rounded-xl font-extrabold
                                            {{ $item->nilai >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $item->nilai }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">Nilai Tugas</h2>

                    @if ($nilaiTugas->isEmpty())
                        <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                            Belum ada nilai tugas.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($nilaiTugas as $item)
                                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <h3 class="font-extrabold text-slate-800 text-lg">
                                                {{ $item->siswa->name ?? 'Siswa' }}
                                            </h3>
                                            <p class="text-sm text-slate-500 mt-1">
                                                {{ $item->tugas->judul ?? '-' }}
                                            </p>
                                            <p class="text-sm text-slate-500">
                                                Kelas: {{ $item->tugas->kelas->nama_kelas ?? '-' }}
                                            </p>
                                        </div>

                                        <span class="px-4 py-2 rounded-xl font-extrabold
                                            {{ $item->nilai >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $item->nilai }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-slate-600 mt-4">
                                        Komentar: {{ $item->komentar ?? '-' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
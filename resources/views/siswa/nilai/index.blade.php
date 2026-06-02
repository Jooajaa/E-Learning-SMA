<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            @php
                $nilaiKuisData = $nilaiKuis ?? collect();
                $nilaiTugasData = $nilaiTugas ?? collect();
            @endphp

            <div class="bg-gradient-to-r from-purple-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <p class="text-purple-100 font-semibold mb-2">Hasil Belajar</p>
                <h1 class="text-3xl md:text-4xl font-extrabold">Nilai Siswa</h1>
                <p class="text-purple-100 mt-3 max-w-2xl">
                    Lihat hasil nilai dari kuis dan tugas yang sudah kamu kerjakan.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">Nilai Kuis</h2>

                    @if ($nilaiKuisData->isEmpty())
                        <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                            Belum ada nilai kuis.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($nilaiKuisData as $item)
                                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <h3 class="font-extrabold text-slate-800 text-lg">
                                                {{ $item->kuis->judul ?? 'Kuis' }}
                                            </h3>
                                            <p class="text-sm text-slate-500 mt-1">
                                                Guru: {{ $item->guru->name ?? $item->kuis->guru->name ?? '-' }}
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

                    @if ($nilaiTugasData->isEmpty())
                        <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                            Belum ada nilai tugas.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($nilaiTugasData as $item)
                                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <h3 class="font-extrabold text-slate-800 text-lg">
                                                {{ $item->tugas->judul ?? 'Tugas' }}
                                            </h3>
                                            <p class="text-sm text-slate-500 mt-1">
                                                Status: {{ ucfirst($item->status ?? '-') }}
                                            </p>
                                        </div>

                                        <span class="px-4 py-2 rounded-xl font-extrabold
                                            {{ ($item->nilai ?? 0) >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $item->nilai ?? '-' }}
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
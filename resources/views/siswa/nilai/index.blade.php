<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-purple-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-purple-100 font-semibold mb-2">
                            Hasil Belajar
                        </p>

                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Nilai Siswa
                        </h1>

                        <p class="text-purple-100 mt-3">
                            Lihat hasil nilai dari kuis dan tugas yang sudah kamu kerjakan.
                        </p>

                        @if (isset($mapel) && $mapel)
                            <div class="mt-5 inline-flex items-center gap-2 bg-white/15 border border-white/20 px-4 py-2 rounded-xl">
                                <span class="text-purple-100 text-sm">
                                    Mata Pelajaran:
                                </span>

                                <span class="font-bold">
                                    {{ $mapel->nama_mapel ?? $mapel->nama_mata_pelajaran ?? '-' }}
                                </span>
                            </div>
                        @endif
                    </div>

                    @if (request('mata_pelajaran_id'))
                        <a href="{{ route('siswa.mapel.show', request('mata_pelajaran_id')) }}"
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

            @if (!request('mata_pelajaran_id'))
                <div class="mb-6 p-4 bg-yellow-100 border border-yellow-300 text-yellow-700 rounded-2xl">
                    Nilai sebaiknya dibuka dari halaman mata pelajaran agar tampil sesuai mapel.
                    Silakan kembali ke dashboard, pilih mata pelajaran, lalu klik Nilai.
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- NILAI KUIS --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">
                                Nilai Kuis
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Daftar nilai dari kuis yang sudah kamu kerjakan.
                            </p>
                        </div>

                        <div class="bg-amber-50 text-amber-700 px-4 py-2 rounded-xl font-bold text-sm">
                            Total: {{ isset($nilaiKuis) ? $nilaiKuis->count() : 0 }}
                        </div>
                    </div>

                    @if (!isset($nilaiKuis) || $nilaiKuis->isEmpty())
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 text-center text-slate-500">
                            Belum ada nilai kuis.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-200">
                                <thead>
                                    <tr class="bg-slate-50">
                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            No
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Kuis
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Mapel
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Nilai
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Keterangan
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-slate-200">
                                    @foreach ($nilaiKuis as $item)
                                        <tr class="hover:bg-slate-50">
                                            <td class="px-4 py-4 text-sm text-slate-600">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-4 py-4 text-sm font-semibold text-slate-800">
                                                {{ $item->kuis->judul ?? '-' }}
                                            </td>

                                            <td class="px-4 py-4 text-sm text-slate-600">
                                                {{ $item->mataPelajaran->nama_mapel ?? $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                            </td>

                                            <td class="px-4 py-4 text-sm">
                                                @php
                                                    $nilai = $item->nilai ?? 0;
                                                @endphp

                                                @if ($nilai >= 80)
                                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                                        {{ $nilai }}
                                                    </span>
                                                @elseif ($nilai >= 60)
                                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                                        {{ $nilai }}
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                                        {{ $nilai }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="px-4 py-4 text-sm text-slate-600">
                                                {{ $item->keterangan ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                {{-- NILAI TUGAS --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">
                                Nilai Tugas
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Daftar nilai dari tugas yang sudah dinilai guru.
                            </p>
                        </div>

                        <div class="bg-green-50 text-green-700 px-4 py-2 rounded-xl font-bold text-sm">
                            Total: {{ isset($nilaiTugas) ? $nilaiTugas->count() : 0 }}
                        </div>
                    </div>

                    @if (!isset($nilaiTugas) || $nilaiTugas->isEmpty())
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 text-center text-slate-500">
                            Belum ada nilai tugas.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-200">
                                <thead>
                                    <tr class="bg-slate-50">
                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            No
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Tugas
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Mapel
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Nilai
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Keterangan
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-slate-200">
                                    @foreach ($nilaiTugas as $item)
                                        <tr class="hover:bg-slate-50">
                                            <td class="px-4 py-4 text-sm text-slate-600">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-4 py-4 text-sm font-semibold text-slate-800">
                                                {{ $item->tugas->judul ?? '-' }}
                                            </td>

                                            <td class="px-4 py-4 text-sm text-slate-600">
                                                {{ $item->mataPelajaran->nama_mapel ?? $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                            </td>

                                            <td class="px-4 py-4 text-sm">
                                                @php
                                                    $nilai = $item->nilai ?? 0;
                                                @endphp

                                                @if ($nilai >= 80)
                                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                                        {{ $nilai }}
                                                    </span>
                                                @elseif ($nilai >= 60)
                                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                                        {{ $nilai }}
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                                        {{ $nilai }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="px-4 py-4 text-sm text-slate-600">
                                                {{ $item->keterangan ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
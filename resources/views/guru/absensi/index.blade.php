<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-cyan-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-cyan-100 font-semibold mb-2">
                            Rekap Kehadiran
                        </p>

                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Absensi Siswa
                        </h1>

                        <p class="text-cyan-100 mt-3">
                            Pantau kehadiran siswa berdasarkan kelas dan mata pelajaran yang kamu ajar.
                        </p>

                        @if (isset($guruKelas) && $guruKelas)
                            <div class="mt-5 inline-flex items-center gap-2 bg-white/15 border border-white/20 px-4 py-2 rounded-xl">
                                <span class="text-cyan-100 text-sm">Kelas:</span>
                                <span class="font-bold">
                                    {{ $guruKelas->kelas->nama_kelas ?? '-' }}
                                </span>

                                <span class="text-cyan-100 text-sm ml-3">Mapel:</span>
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

            @if (!isset($absensi) || $absensi->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada data absensi untuk kelas dan mata pelajaran ini.
                </div>
            @else
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">
                                Daftar Absensi
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Total data: {{ $absensi->count() }} absensi
                            </p>
                        </div>

                        @if (isset($guruKelas) && $guruKelas)
                            <div class="bg-cyan-50 text-cyan-700 px-4 py-2 rounded-xl font-bold text-sm">
                                {{ $guruKelas->kelas->nama_kelas ?? '-' }}
                                -
                                {{ $guruKelas->mataPelajaran->nama_mapel ?? $guruKelas->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                            </div>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                        No
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                        Nama Siswa
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                        Kelas
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                        Mata Pelajaran
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                        Tanggal
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                        Status
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                        Keterangan
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-200">
                                @foreach ($absensi as $item)
                                    @php
                                        $status = strtolower($item->status);
                                    @endphp

                                    <tr class="hover:bg-slate-50">
                                        <td class="px-4 py-4 text-sm text-slate-600">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-4 py-4 text-sm font-semibold text-slate-800">
                                            {{ $item->siswa->name ?? '-' }}
                                        </td>

                                        <td class="px-4 py-4 text-sm text-slate-600">
                                            {{ $item->kelas->nama_kelas ?? '-' }}
                                        </td>

                                        <td class="px-4 py-4 text-sm text-slate-600">
                                            {{ $item->mataPelajaran->nama_mapel ?? $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                        </td>

                                        <td class="px-4 py-4 text-sm text-slate-600">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            @if ($status == 'hadir')
                                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                                    Hadir
                                                </span>
                                            @elseif ($status == 'izin')
                                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                                    Izin
                                                </span>
                                            @elseif ($status == 'sakit')
                                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                                    Sakit
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                                    Alpha
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
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
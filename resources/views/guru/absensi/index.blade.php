<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-cyan-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <p class="text-cyan-100 font-semibold mb-2">Rekap Kehadiran</p>
                <h1 class="text-3xl md:text-4xl font-extrabold">Absensi Siswa</h1>
                <p class="text-cyan-100 mt-3 max-w-2xl">
                    Pantau kehadiran siswa dari kelas yang kamu ajar.
                </p>
            </div>

            @if ($absensi->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada data absensi.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($absensi as $item)
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <div class="flex items-start justify-between gap-3 mb-5">
                                <div>
                                    <p class="text-sm text-slate-500">Nama Siswa</p>
                                    <h3 class="text-xl font-extrabold text-slate-800 mt-1">
                                        {{ $item->siswa->name ?? '-' }}
                                    </h3>
                                    <p class="text-sm text-slate-500 mt-1">
                                        Kelas:
                                        <span class="font-semibold text-blue-700">
                                            {{ $item->siswa->siswaKelas->kelas->nama_kelas ?? '-' }}
                                        </span>
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    @if (strtolower($item->status) == 'hadir')
                                        bg-green-100 text-green-700
                                    @elseif (strtolower($item->status) == 'izin')
                                        bg-blue-100 text-blue-700
                                    @elseif (strtolower($item->status) == 'sakit')
                                        bg-yellow-100 text-yellow-700
                                    @else
                                        bg-red-100 text-red-700
                                    @endif">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>

                            <div class="space-y-3 text-sm">
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-slate-500">Tanggal</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-slate-500">Keterangan</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->keterangan ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
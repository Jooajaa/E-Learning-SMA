<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-indigo-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-indigo-100 font-semibold mb-2">Jadwal Belajar</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold">Jadwal Siswa</h1>
                        <p class="text-indigo-100 mt-3 max-w-2xl">
                            Lihat jadwal pelajaran mingguan berdasarkan kelas kamu.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[180px]">
                        <p class="text-indigo-100 text-sm">Total Jadwal</p>
                        <p class="text-3xl font-extrabold mt-1">{{ $jadwal->count() }}</p>
                    </div>
                </div>
            </div>

            @if ($jadwal->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada jadwal pelajaran untuk kelas kamu.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($jadwal as $item)
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition">
                            <div class="flex items-start justify-between gap-3 mb-5">
                                <div>
                                    <p class="text-sm text-slate-500">Hari</p>
                                    <h3 class="text-2xl font-extrabold text-slate-800 mt-1">
                                        {{ $item->hari }}
                                    </h3>
                                </div>

                                <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold">
                                    Jadwal
                                </span>
                            </div>

                            <div class="space-y-3 text-sm">
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-slate-500">Jam</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-slate-500">Mata Pelajaran</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->mataPelajaran->nama_mapel ?? '-' }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-slate-500">Guru</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->guru->name ?? '-' }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-slate-500">Ruangan</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->ruangan ?? '-' }}
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
<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-indigo-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-indigo-100 font-semibold mb-2">Manajemen Akademik</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold">Jadwal Pelajaran</h1>
                        <p class="text-indigo-100 mt-3 max-w-2xl">
                            Kelola jadwal belajar berdasarkan kelas, guru, mata pelajaran, hari, jam, dan ruangan.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[180px]">
                        <p class="text-indigo-100 text-sm">Total Jadwal</p>
                        <p class="text-3xl font-extrabold mt-1">{{ $jadwal->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Daftar Jadwal</h2>
                    <p class="text-slate-500 text-sm mt-1">
                        Tambahkan jadwal agar guru dan siswa dapat melihat jadwal sesuai kelasnya.
                    </p>
                </div>

                <a href="{{ route('admin.jadwal.create') }}"
                    class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl shadow-sm transition">
                    + Tambah Jadwal
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            @if ($jadwal->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada jadwal pelajaran.
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

                            <div class="space-y-3 text-sm mb-5">
                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                    <p class="text-slate-500">Jam Pelajaran</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                        <p class="text-slate-500">Kelas</p>
                                        <p class="font-bold text-slate-800 mt-1">{{ $item->kelas->nama_kelas ?? '-' }}</p>
                                    </div>

                                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                        <p class="text-slate-500">Ruangan</p>
                                        <p class="font-bold text-slate-800 mt-1">{{ $item->ruangan ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                    <p class="text-slate-500">Mata Pelajaran</p>
                                    <p class="font-bold text-slate-800 mt-1">{{ $item->mataPelajaran->nama_mapel ?? '-' }}</p>
                                </div>

                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                    <p class="text-slate-500">Guru</p>
                                    <p class="font-bold text-slate-800 mt-1">{{ $item->guru->name ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('admin.jadwal.edit', $item->id) }}"
                                    class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-white font-semibold px-4 py-2 rounded-xl transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST"
                                    class="flex-1"
                                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-xl transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
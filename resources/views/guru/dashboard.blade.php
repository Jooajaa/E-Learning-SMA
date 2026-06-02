<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-blue-700 to-indigo-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <p class="text-blue-100 font-semibold mb-2">Dashboard Guru</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Selamat datang, {{ Auth::user()->name }}
                        </h1>
                        <p class="text-blue-100 mt-3 max-w-2xl">
                            Kelola materi, tugas, kuis, nilai, absensi, dan jadwal mengajar sesuai kelas yang ditugaskan.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[220px]">
                        <p class="text-blue-100 text-sm">Role Aktif</p>
                        <p class="text-2xl font-bold mt-1">Guru</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Kelas Mengajar</h2>
                        <p class="text-slate-500 text-sm mt-1">
                            Daftar kelas dan mata pelajaran yang ditugaskan kepada kamu.
                        </p>
                    </div>
                </div>

                @if (($user->guruKelas ?? collect())->isEmpty())
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 text-slate-500">
                        Belum ada kelas yang ditugaskan.
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($user->guruKelas as $item)
                            <div class="border border-slate-200 rounded-xl p-5 bg-slate-50">
                                <p class="text-sm text-slate-500">Kelas</p>
                                <h3 class="text-xl font-bold text-slate-800 mt-1">
                                    {{ $item->kelas->nama_kelas ?? 'Kelas tidak ditemukan' }}
                                </h3>
                                <p class="text-sm text-slate-600 mt-2">
                                    Mapel:
                                    <span class="font-semibold">
                                        {{ $item->mapel->nama_mapel ?? $item->mataPelajaran->nama_mapel ?? '-' }}
                                    </span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('guru.materi.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold mb-4">MT</div>
                    <h2 class="text-lg font-bold text-slate-800">Materi</h2>
                    <p class="text-sm text-slate-500 mt-2">Upload dan kelola materi kelas.</p>
                </a>

                <a href="{{ route('guru.tugas.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-bold mb-4">TG</div>
                    <h2 class="text-lg font-bold text-slate-800">Tugas</h2>
                    <p class="text-sm text-slate-500 mt-2">Buat tugas dan pantau pengumpulan.</p>
                </a>

                <a href="{{ route('guru.kuis.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold mb-4">KZ</div>
                    <h2 class="text-lg font-bold text-slate-800">Kuis</h2>
                    <p class="text-sm text-slate-500 mt-2">Buat kuis dan soal pilihan ganda.</p>
                </a>

                <a href="{{ route('guru.pengumpulan.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold mb-4">PG</div>
                    <h2 class="text-lg font-bold text-slate-800">Pengumpulan</h2>
                    <p class="text-sm text-slate-500 mt-2">Periksa jawaban dan beri nilai.</p>
                </a>

                <a href="{{ route('guru.nilai.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-red-100 text-red-700 flex items-center justify-center font-bold mb-4">NL</div>
                    <h2 class="text-lg font-bold text-slate-800">Nilai</h2>
                    <p class="text-sm text-slate-500 mt-2">Lihat rekap nilai siswa.</p>
                </a>

                <a href="{{ route('guru.absensi.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold mb-4">AB</div>
                    <h2 class="text-lg font-bold text-slate-800">Absensi</h2>
                    <p class="text-sm text-slate-500 mt-2">Pantau kehadiran siswa.</p>
                </a>

                <a href="{{ route('guru.jadwal.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold mb-4">JD</div>
                    <h2 class="text-lg font-bold text-slate-800">Jadwal</h2>
                    <p class="text-sm text-slate-500 mt-2">Lihat jadwal mengajar.</p>
                </a>

                <a href="{{ route('kalender.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold mb-4">KA</div>
                    <h2 class="text-lg font-bold text-slate-800">Kalender</h2>
                    <p class="text-sm text-slate-500 mt-2">Lihat kalender akademik.</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
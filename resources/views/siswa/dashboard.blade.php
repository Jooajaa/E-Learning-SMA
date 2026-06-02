<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-blue-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <p class="text-blue-100 font-semibold mb-2">Dashboard Siswa</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Halo, {{ Auth::user()->name }}
                        </h1>
                        <p class="text-blue-100 mt-3 max-w-2xl">
                            Akses materi, tugas, kuis, nilai, absensi, dan jadwal pelajaran sesuai kelas kamu.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[220px]">
                        <p class="text-blue-100 text-sm">Kelas Kamu</p>
                        <p class="text-2xl font-bold mt-1">
                            {{ $user->siswaKelas->kelas->nama_kelas ?? 'Belum ada kelas' }}
                        </p>
                        <p class="text-blue-100 text-sm mt-1">
                            {{ $user->siswaKelas->tahun_ajaran ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm mb-8">
                <h2 class="text-xl font-bold text-slate-800">Mata Pelajaran di Kelas Kamu</h2>
                <p class="text-slate-500 text-sm mt-1 mb-5">
                    Daftar mata pelajaran berdasarkan kelas yang kamu ikuti.
                </p>

                @if (!empty($user->siswaKelas) && !empty($user->siswaKelas->kelas) && $user->siswaKelas->kelas->guruKelas->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($user->siswaKelas->kelas->guruKelas as $item)
                            <div class="bg-slate-50 border border-slate-200 rounded-xl p-5">
                                <p class="text-sm text-slate-500">Mata Pelajaran</p>
                                <h3 class="text-xl font-bold text-slate-800 mt-1">
                                    {{ $item->mataPelajaran->nama_mapel ?? $item->mapel->nama_mapel ?? '-' }}
                                </h3>
                                <p class="text-sm text-slate-600 mt-2">
                                    Guru:
                                    <span class="font-semibold">
                                        {{ $item->guru->name ?? '-' }}
                                    </span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 text-slate-500">
                        Belum ada mata pelajaran yang ditugaskan untuk kelas kamu.
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('siswa.materi.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold mb-4">MT</div>
                    <h2 class="text-lg font-bold text-slate-800">Materi</h2>
                    <p class="text-sm text-slate-500 mt-2">Baca materi dari guru sesuai kelas.</p>
                </a>

                <a href="{{ route('siswa.tugas.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-bold mb-4">TG</div>
                    <h2 class="text-lg font-bold text-slate-800">Tugas</h2>
                    <p class="text-sm text-slate-500 mt-2">Kerjakan dan kumpulkan tugas.</p>
                </a>

                <a href="{{ route('siswa.kuis.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold mb-4">KZ</div>
                    <h2 class="text-lg font-bold text-slate-800">Kuis</h2>
                    <p class="text-sm text-slate-500 mt-2">Kerjakan kuis yang tersedia.</p>
                </a>

                <a href="{{ route('siswa.nilai.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold mb-4">NL</div>
                    <h2 class="text-lg font-bold text-slate-800">Nilai</h2>
                    <p class="text-sm text-slate-500 mt-2">Lihat hasil tugas dan kuis.</p>
                </a>

                <a href="{{ route('siswa.absensi.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold mb-4">AB</div>
                    <h2 class="text-lg font-bold text-slate-800">Absensi</h2>
                    <p class="text-sm text-slate-500 mt-2">Isi dan lihat riwayat absensi.</p>
                </a>

                <a href="{{ route('siswa.jadwal.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold mb-4">JD</div>
                    <h2 class="text-lg font-bold text-slate-800">Jadwal</h2>
                    <p class="text-sm text-slate-500 mt-2">Lihat jadwal pelajaran kelas.</p>
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
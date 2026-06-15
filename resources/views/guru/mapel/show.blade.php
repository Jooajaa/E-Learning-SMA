<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-indigo-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-indigo-100 font-semibold mb-2">
                            Ruang Mengajar
                        </p>

                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            {{ $guruKelas->kelas->nama_kelas ?? '-' }}
                            -
                            {{ $guruKelas->mataPelajaran->nama_mapel ?? '-' }}
                        </h1>

                        <p class="text-indigo-100 mt-3">
                            Kelola pembelajaran untuk kelas dan mata pelajaran ini.
                        </p>
                    </div>

                    <a href="{{ route('guru.dashboard') }}"
                        class="bg-white/15 hover:bg-white/25 border border-white/20 text-white font-bold px-5 py-3 rounded-xl transition">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Materi --}}
                <a href="{{ route('guru.mapel.materi', $guruKelas->id) }}"
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition block">

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl mb-5">
                        📚
                    </div>

                    <h3 class="text-xl font-extrabold text-slate-800">
                        Materi
                    </h3>

                    <p class="text-slate-500 text-sm mt-2">
                        Tambah dan kelola materi pembelajaran untuk mapel ini.
                    </p>

                    <p class="text-3xl font-extrabold text-blue-700 mt-5">
                        {{ $materiCount }}
                    </p>
                </a>

                {{-- Tugas --}}
                <a href="{{ route('guru.mapel.tugas', $guruKelas->id) }}"
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition block">

                    <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-700 flex items-center justify-center text-2xl mb-5">
                        📝
                    </div>

                    <h3 class="text-xl font-extrabold text-slate-800">
                        Tugas
                    </h3>

                    <p class="text-slate-500 text-sm mt-2">
                        Buat dan pantau tugas siswa untuk mapel ini.
                    </p>

                    <p class="text-3xl font-extrabold text-green-700 mt-5">
                        {{ $tugasCount }}
                    </p>
                </a>

                {{-- Kuis --}}
                <a href="{{ route('guru.mapel.kuis', $guruKelas->id) }}"
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition block">

                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl mb-5">
                        🧠
                    </div>

                    <h3 class="text-xl font-extrabold text-slate-800">
                        Kuis
                    </h3>

                    <p class="text-slate-500 text-sm mt-2">
                        Buat kuis pilihan ganda untuk mapel ini.
                    </p>

                    <p class="text-3xl font-extrabold text-amber-700 mt-5">
                        {{ $kuisCount }}
                    </p>
                </a>

                {{-- Pengumpulan --}}
                <a href="{{ route('guru.pengumpulan.index', ['guru_kelas_id' => $guruKelas->id]) }}"
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition block">

                    <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center text-2xl mb-5">
                        📥
                    </div>

                    <h3 class="text-xl font-extrabold text-slate-800">
                        Pengumpulan
                    </h3>

                    <p class="text-slate-500 text-sm mt-2">
                        Lihat jawaban tugas yang sudah dikumpulkan siswa.
                    </p>

                    <p class="text-lg font-bold text-purple-700 mt-5">
                        Lihat Data
                    </p>
                </a>

                {{-- Nilai --}}
                <a href="{{ route('guru.nilai.index', ['guru_kelas_id' => $guruKelas->id]) }}"
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition block">

                    <div class="w-14 h-14 rounded-2xl bg-red-100 text-red-700 flex items-center justify-center text-2xl mb-5">
                        🏆
                    </div>

                    <h3 class="text-xl font-extrabold text-slate-800">
                        Nilai
                    </h3>

                    <p class="text-slate-500 text-sm mt-2">
                        Lihat dan pantau nilai siswa pada kelas dan mapel ini.
                    </p>

                    <p class="text-lg font-bold text-red-700 mt-5">
                        Lihat Nilai
                    </p>
                </a>

                {{-- Absensi --}}
                <a href="{{ route('guru.absensi.index', ['guru_kelas_id' => $guruKelas->id]) }}"
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition block">

                    <div class="w-14 h-14 rounded-2xl bg-cyan-100 text-cyan-700 flex items-center justify-center text-2xl mb-5">
                        ✅
                    </div>

                    <h3 class="text-xl font-extrabold text-slate-800">
                        Absensi
                    </h3>

                    <p class="text-slate-500 text-sm mt-2">
                        Pantau kehadiran siswa pada kelas yang kamu ajar.
                    </p>

                    <p class="text-lg font-bold text-cyan-700 mt-5">
                        Lihat Absensi
                    </p>
                </a>

            </div>

            <div class="mt-8 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-xl font-bold text-slate-800 mb-2">
                    Informasi Penugasan
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                        <p class="text-sm text-slate-500">Kelas</p>
                        <p class="text-lg font-bold text-slate-800 mt-1">
                            {{ $guruKelas->kelas->nama_kelas ?? '-' }}
                        </p>
                    </div>

                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                        <p class="text-sm text-slate-500">Mata Pelajaran</p>
                        <p class="text-lg font-bold text-slate-800 mt-1">
                            {{ $guruKelas->mataPelajaran->nama_mapel ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
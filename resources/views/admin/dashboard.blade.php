<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-blue-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <p class="text-blue-100 font-semibold mb-2">Dashboard Admin</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Selamat datang, {{ Auth::user()->name }}
                        </h1>
                        <p class="text-blue-100 mt-3 max-w-2xl">
                            Kelola data utama LMS SMA seperti kelas, guru, siswa, mata pelajaran, jadwal, dan penugasan akademik.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[220px]">
                        <p class="text-blue-100 text-sm">Role Aktif</p>
                        <p class="text-2xl font-bold mt-1">Administrator</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <a href="{{ route('admin.kelas.index') }}"
                    class="group bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold mb-4">
                        KL
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Data Kelas</h2>
                    <p class="text-sm text-slate-500 mt-2">
                        Kelola kelas seperti IPA 1, IPA 2, dan kelas lainnya.
                    </p>
                </a>

                <a href="{{ route('admin.mapel.index') }}"
                    class="group bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold mb-4">
                        MP
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Mata Pelajaran</h2>
                    <p class="text-sm text-slate-500 mt-2">
                        Atur daftar mata pelajaran yang digunakan di LMS.
                    </p>
                </a>

                <a href="{{ route('admin.siswa.index') }}"
                    class="group bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-bold mb-4">
                        SW
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Data Siswa</h2>
                    <p class="text-sm text-slate-500 mt-2">
                        Kelola akun siswa dan data kelas siswa.
                    </p>
                </a>

                <a href="{{ route('admin.guru.index') }}"
                    class="group bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold mb-4">
                        GR
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Data Guru</h2>
                    <p class="text-sm text-slate-500 mt-2">
                        Kelola akun guru dan data pengajar.
                    </p>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <a href="{{ route('admin.penugasan.index') }}"
                    class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
                    <h2 class="text-xl font-bold text-slate-800">Penugasan Akademik</h2>
                    <p class="text-slate-500 mt-2">
                        Atur siswa ke kelas, guru ke mapel, dan guru ke kelas.
                    </p>
                    <div class="mt-5 text-blue-700 font-bold">Kelola Penugasan →</div>
                </a>

                <a href="{{ route('admin.jadwal.index') }}"
                    class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
                    <h2 class="text-xl font-bold text-slate-800">Jadwal Pelajaran</h2>
                    <p class="text-slate-500 mt-2">
                        Susun jadwal belajar berdasarkan kelas, guru, dan mapel.
                    </p>
                    <div class="mt-5 text-blue-700 font-bold">Kelola Jadwal →</div>
                </a>

                <a href="{{ route('admin.import.index') }}"
                    class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
                    <h2 class="text-xl font-bold text-slate-800">Import Data</h2>
                    <p class="text-slate-500 mt-2">
                        Import data siswa dan guru agar input lebih cepat.
                    </p>
                    <div class="mt-5 text-blue-700 font-bold">Buka Import →</div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
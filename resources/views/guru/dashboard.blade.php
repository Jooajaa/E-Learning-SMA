<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Dashboard Guru 👨‍🏫
                </h1>
                <p class="text-gray-500 mt-1">
                    Selamat datang, {{ Auth::user()->name }}. Kelola aktivitas pembelajaran siswa di LMS SMA.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <a href="{{ route('guru.kuis.index') }}"
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">📝</div>
                    <h2 class="text-lg font-bold text-gray-800">Kuis</h2>
                    <p class="text-gray-500 text-sm mt-1">
                        Kelola kuis dan soal pilihan ganda.
                    </p>
                </a>

                <a href="{{ route('guru.nilai.index') }}"
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">📊</div>
                    <h2 class="text-lg font-bold text-gray-800">Nilai</h2>
                    <p class="text-gray-500 text-sm mt-1">
                        Lihat hasil nilai siswa.
                    </p>
                </a>

                <a href="{{ route('guru.absensi.index') }}"
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">✅</div>
                    <h2 class="text-lg font-bold text-gray-800">Absensi</h2>
                    <p class="text-gray-500 text-sm mt-1">
                        Lihat rekap kehadiran siswa.
                    </p>
                </a>

                <a href="{{ route('guru.jadwal.index') }}"
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">📅</div>
                    <h2 class="text-lg font-bold text-gray-800">Jadwal</h2>
                    <p class="text-gray-500 text-sm mt-1">
                        Lihat jadwal mengajar.
                    </p>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Dashboard Admin 👨‍💼
                </h1>
                <p class="text-gray-500 mt-1">
                    Selamat datang, {{ Auth::user()->name }}. Kelola sistem LMS SMA dari halaman admin.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="text-3xl mb-3">👥</div>
                    <h2 class="text-lg font-bold text-gray-800">Pengguna</h2>
                    <p class="text-gray-500 text-sm mt-1">
                        Kelola data admin, guru, dan siswa.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="text-3xl mb-3">🏫</div>
                    <h2 class="text-lg font-bold text-gray-800">Kelas</h2>
                    <p class="text-gray-500 text-sm mt-1">
                        Kelola data kelas dan penugasan siswa.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="text-3xl mb-3">📚</div>
                    <h2 class="text-lg font-bold text-gray-800">Mata Pelajaran</h2>
                    <p class="text-gray-500 text-sm mt-1">
                        Kelola mata pelajaran dan guru pengampu.
                    </p>
                </div>

                <a href="{{ route('kalender.index') }}"
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">📅</div>
                    <h2 class="text-lg font-bold text-gray-800">Kalender</h2>
                    <p class="text-gray-500 text-sm mt-1">
                        Lihat kalender akademik sekolah.
                    </p>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
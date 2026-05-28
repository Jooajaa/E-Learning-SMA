<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    Dashboard Siswa 👨‍🎓
                </h1>

                <p class="text-gray-600 mb-2">
                    Selamat datang,
                    <span class="font-semibold">
                        {{ Auth::user()->name }}
                    </span>
                </p>

                <p class="text-gray-500">
                    Anda login sebagai Siswa.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
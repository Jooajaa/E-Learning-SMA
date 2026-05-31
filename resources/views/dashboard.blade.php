<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Dashboard
                </h1>

                <p class="text-gray-600 mt-2">
                    Selamat datang di LMS SMA.
                </p>

                <div class="mt-4">
                    <a href="{{ route('dashboard') }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg">
                        Masuk ke Dashboard
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Detail Materi
                </h1>
                <p class="text-gray-500 mt-1">
                    Informasi lengkap materi pembelajaran.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="mb-5">
                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold">
                        Materi Pembelajaran
                    </span>
                </div>

                <h2 class="text-2xl font-bold text-gray-800 mb-3">
                    {{ $materi->judul }}
                </h2>

                <p class="text-gray-600 mb-6">
                    {{ $materi->deskripsi ?? 'Tidak ada deskripsi.' }}
                </p>

                <div class="flex flex-wrap gap-3">
                    @if ($materi->file)
                        <a href="{{ asset('storage/' . $materi->file) }}" target="_blank"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-sm transition">
                            Download Materi
                        </a>
                    @else
                        <span class="bg-gray-200 text-gray-600 font-semibold px-5 py-2 rounded-lg">
                            Tidak Ada File
                        </span>
                    @endif

                    <a href="{{ route('siswa.materi.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 py-2 rounded-lg transition">
                        Kembali
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
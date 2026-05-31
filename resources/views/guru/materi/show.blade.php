<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Detail Materi
                        </h1>
                        <p class="text-gray-500 mt-1">
                            Informasi lengkap materi pembelajaran.
                        </p>
                    </div>

                    <a href="{{ route('guru.materi.index') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                        Kembali
                    </a>
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Materi
                        </label>

                        <div class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 font-semibold">
                            {{ $materi->judul ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>

                        <div class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 min-h-[120px]">
                            {{ $materi->deskripsi ?? 'Tidak ada deskripsi.' }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            File Materi
                        </label>

                        <div class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3">
                            @if ($materi->file)
                                <a href="{{ asset('storage/' . $materi->file) }}" target="_blank"
                                    class="text-blue-600 hover:underline font-semibold">
                                    Download File Materi
                                </a>
                            @else
                                <span class="text-gray-600">
                                    Tidak ada file
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('guru.materi.edit', $materi->id) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-5 py-2 rounded-lg transition">
                        Edit Materi
                    </a>

                    <a href="{{ route('guru.materi.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 py-2 rounded-lg transition">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
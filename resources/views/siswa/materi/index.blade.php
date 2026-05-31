<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Daftar Materi Siswa
                </h1>
                <p class="text-gray-500 mt-1">
                    Lihat materi pembelajaran yang sudah diberikan oleh guru.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($materi as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $item->judul }}
                                </h2>

                                <p class="text-sm text-gray-500 mt-1">
                                    Materi Pembelajaran
                                </p>
                            </div>

                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold">
                                Materi
                            </span>
                        </div>

                        <p class="text-gray-600 mb-5">
                            {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
                        </p>

                        <a href="{{ route('siswa.materi.show', $item->id) }}"
                            class="inline-block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                            Lihat Detail
                        </a>
                    </div>
                @empty
                    <div class="col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-gray-500">
                            Belum ada materi yang tersedia.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
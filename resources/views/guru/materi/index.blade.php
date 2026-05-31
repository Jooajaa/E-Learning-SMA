<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        Daftar Materi
                    </h1>
                    <p class="text-gray-500 mt-1">
                        Kelola materi pembelajaran yang akan diberikan kepada siswa.
                    </p>
                </div>

                <a href="{{ route('guru.materi.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-sm transition">
                    + Tambah Materi
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

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

                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('guru.materi.show', $item->id) }}"
                                class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                Detail
                            </a>

                            <a href="{{ route('guru.materi.edit', $item->id) }}"
                                class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-lg transition">
                                Edit
                            </a>

                            <form action="{{ route('guru.materi.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus materi ini?')" class="w-full">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-gray-500 mb-4">
                            Belum ada materi.
                        </p>

                        <a href="{{ route('guru.materi.create') }}"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg">
                            + Tambah Materi Pertama
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
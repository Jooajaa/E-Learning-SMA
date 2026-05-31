<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Edit Materi
                </h1>
                <p class="text-gray-500 mt-1">
                    Perbarui data materi pembelajaran.
                </p>
            </div>

            <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('guru.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Materi
                        </label>

                        <input type="text" name="judul"
                            value="{{ old('judul', $materi->judul) }}"
                            placeholder="Contoh: Materi Matematika Bab 1"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi" rows="5"
                            placeholder="Tuliskan deskripsi singkat materi"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            File Saat Ini
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

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Ganti File Materi
                        </label>

                        <input type="file" name="file"
                            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-2">

                        <p class="text-xs text-gray-500 mt-2">
                            Kosongkan jika tidak ingin mengganti file materi.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-sm transition">
                            Update Materi
                        </button>

                        <a href="{{ route('guru.materi.show', $materi->id) }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                            Detail Materi
                        </a>

                        <a href="{{ route('guru.materi.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 py-2 rounded-lg transition">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Tambah Materi
                </h1>
                <p class="text-gray-500 mt-1">
                    Upload materi pembelajaran untuk siswa.
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

                <form action="{{ route('guru.materi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Materi
                        </label>

                        <input type="text" name="judul" value="{{ old('judul') }}"
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
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            File Materi
                        </label>

                        <input type="file" name="file"
                            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-2">

                        <p class="text-xs text-gray-500 mt-2">
                            Upload file materi seperti PDF, DOCX, PPT, atau gambar.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-sm transition">
                            Upload Materi
                        </button>

                        <a href="{{ route('guru.materi.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 py-2 rounded-lg transition">
                            Batal
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
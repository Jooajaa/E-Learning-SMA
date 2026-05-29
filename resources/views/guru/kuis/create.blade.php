<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Tambah Kuis
                </h1>
                <p class="text-gray-500 mt-1">
                    Buat kuis baru untuk siswa.
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

                <form action="{{ route('guru.kuis.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Kuis
                        </label>

                        <input type="text" name="judul" value="{{ old('judul') }}"
                            placeholder="Contoh: Kuis Matematika Dasar"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi" rows="4"
                            placeholder="Tuliskan deskripsi singkat kuis"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Waktu Mulai
                            </label>

                            <input type="datetime-local" name="waktu_mulai" value="{{ old('waktu_mulai') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Waktu Selesai
                            </label>

                            <input type="datetime-local" name="waktu_selesai" value="{{ old('waktu_selesai') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-sm transition">
                            Simpan Kuis
                        </button>

                        <a href="{{ route('guru.kuis.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 py-2 rounded-lg transition">
                            Batal
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
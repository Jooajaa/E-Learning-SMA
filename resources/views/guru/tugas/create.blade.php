<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="mb-6">
                <h1 class="text-3xl font-extrabold text-slate-800">Tambah Tugas</h1>
                <p class="text-slate-500 mt-1">
                    Buat tugas baru untuk kelas yang kamu ajar.
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-2xl">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($kelas->isEmpty())
                    <div class="mb-6 p-4 bg-yellow-100 border border-yellow-300 text-yellow-700 rounded-2xl">
                        Kamu belum ditugaskan mengajar kelas mana pun. Hubungi admin untuk mengatur penugasan.
                    </div>
                @endif

                <form action="{{ route('guru.tugas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kelas</label>
                        <select name="kelas_id" required
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}" {{ old('kelas_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Tugas</label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                            placeholder="Contoh: Laporan Praktikum Pertemuan 10"
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Instruksi</label>
                        <textarea name="instruksi" rows="6"
                            placeholder="Tulis instruksi pengerjaan tugas dengan jelas"
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('instruksi') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Deadline</label>
                        <input type="datetime-local" name="deadline" value="{{ old('deadline') }}"
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">File Tugas</label>
                        <input type="file" name="file"
                            class="block w-full text-sm text-slate-700 border border-slate-300 rounded-xl cursor-pointer bg-white p-3">
                        <p class="text-xs text-slate-500 mt-2">
                            Opsional. Upload file pendukung tugas jika diperlukan. Maksimal 5MB.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3 pt-2">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl transition">
                            Simpan Tugas
                        </button>

                        <a href="{{ route('guru.tugas.index') }}"
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-6 py-3 rounded-xl transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
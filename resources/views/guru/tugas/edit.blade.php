<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="mb-6">
                <h1 class="text-3xl font-extrabold text-slate-800">Edit Tugas</h1>
                <p class="text-slate-500 mt-1">
                    Perbarui tugas yang sudah dibuat.
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

                <form action="{{ route('guru.tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kelas</label>
                        <select name="kelas_id" required
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('kelas_id', $tugas->kelas_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Tugas</label>
                        <input type="text" name="judul" value="{{ old('judul', $tugas->judul) }}"
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Instruksi</label>
                        <textarea name="instruksi" rows="6"
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('instruksi', $tugas->instruksi) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Deadline</label>
                        <input type="datetime-local" name="deadline"
                            value="{{ old('deadline', $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline)->format('Y-m-d\TH:i') : '') }}"
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Ganti File Tugas</label>
                        <input type="file" name="file"
                            class="block w-full text-sm text-slate-700 border border-slate-300 rounded-xl cursor-pointer bg-white p-3">

                        <p class="text-xs text-slate-500 mt-2">
                            Kosongkan jika tidak ingin mengganti file.
                        </p>

                        @if ($tugas->file)
                            <a href="{{ asset('storage/' . $tugas->file) }}" target="_blank"
                                class="inline-block mt-3 text-blue-700 font-semibold">
                                Lihat file saat ini
                            </a>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-3 pt-2">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl transition">
                            Update Tugas
                        </button>

                        <a href="{{ route('guru.tugas.index') }}"
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-6 py-3 rounded-xl transition">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
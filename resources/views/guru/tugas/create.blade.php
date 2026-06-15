<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-800">Tambah Tugas</h1>
                <p class="text-slate-500 mt-2">
                    Buat tugas berdasarkan kelas dan mata pelajaran yang sedang dipilih.
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-2xl">
                        <p class="font-bold mb-2">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (isset($guruKelasTerpilih) && $guruKelasTerpilih)
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-2xl p-5">
                        <p class="text-sm text-green-600 font-semibold">Tugas untuk</p>
                        <h2 class="text-xl font-extrabold text-slate-800 mt-1">
                            {{ $guruKelasTerpilih->kelas->nama_kelas ?? '-' }}
                            -
                            {{ $guruKelasTerpilih->mataPelajaran->nama_mapel ?? '-' }}
                        </h2>
                        <p class="text-sm text-slate-500 mt-2">
                            Kelas dan mata pelajaran sudah otomatis dipilih dari ruang mengajar.
                        </p>
                    </div>
                @else
                    <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-2xl p-5">
                        <p class="text-sm text-yellow-700 font-semibold">Pilih kelas dan mata pelajaran</p>
                        <p class="text-sm text-slate-500 mt-1">
                            Karena halaman ini tidak dibuka dari ruang mengajar, kamu perlu memilih kelas dan mata pelajaran terlebih dahulu.
                        </p>
                    </div>
                @endif

                <form action="{{ route('guru.tugas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    @if (isset($guruKelasTerpilih) && $guruKelasTerpilih)
                        <input type="hidden" name="guru_kelas_id" value="{{ $guruKelasTerpilih->id }}">
                        <input type="hidden" name="kelas_id" value="{{ $guruKelasTerpilih->kelas_id }}">
                        <input type="hidden" name="mata_pelajaran_id" value="{{ $guruKelasTerpilih->mata_pelajaran_id }}">
                    @else
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Kelas dan Mata Pelajaran
                            </label>

                            <select name="penugasan" required onchange="isiKelasMapel(this)"
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                                <option value="">-- Pilih Kelas dan Mata Pelajaran --</option>

                                @foreach ($guruKelas as $item)
                                    <option value="{{ $item->kelas_id }}|{{ $item->mata_pelajaran_id }}">
                                        {{ $item->kelas->nama_kelas ?? '-' }}
                                        -
                                        {{ $item->mataPelajaran->nama_mapel ?? '-' }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="hidden" name="kelas_id" id="kelas_id">
                            <input type="hidden" name="mata_pelajaran_id" id="mata_pelajaran_id">
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Tugas</label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required
                            placeholder="Contoh: Tugas Biologi Bab 1"
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Instruksi</label>
                        <textarea name="instruksi" rows="6"
                            placeholder="Tuliskan instruksi tugas"
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('instruksi') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Deadline</label>
                        <input type="datetime-local" name="deadline" value="{{ old('deadline') }}" required
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">File Tugas</label>
                        <input type="file" name="file"
                            class="w-full rounded-xl border border-slate-300 bg-white p-3">
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-xl transition">
                            Simpan Tugas
                        </button>

                        @if (isset($guruKelasTerpilih) && $guruKelasTerpilih)
                            <a href="{{ route('guru.mapel.tugas', $guruKelasTerpilih->id) }}"
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-6 py-3 rounded-xl transition">
                                Batal
                            </a>
                        @else
                            <a href="{{ route('guru.tugas.index') }}"
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-6 py-3 rounded-xl transition">
                                Batal
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function isiKelasMapel(select) {
            const value = select.value;

            if (!value) {
                document.getElementById('kelas_id').value = '';
                document.getElementById('mata_pelajaran_id').value = '';
                return;
            }

            const data = value.split('|');

            document.getElementById('kelas_id').value = data[0];
            document.getElementById('mata_pelajaran_id').value = data[1];
        }
    </script>
</x-app-layout>
<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Header --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-slate-500 text-sm font-semibold">
                            Detail Tugas
                        </p>

                        <h1 class="text-3xl font-extrabold text-slate-800 mt-2">
                            {{ $tugas->judul }}
                        </h1>

                        <p class="text-slate-500 mt-2">
                            Kelas:
                            <span class="font-bold text-blue-700">
                                {{ $tugas->kelas->nama_kelas ?? '-' }}
                            </span>

                            @if ($tugas->mataPelajaran)
                                <span class="mx-2">|</span>
                                Mapel:
                                <span class="font-bold text-blue-700">
                                    {{ $tugas->mataPelajaran->nama_mapel ?? $tugas->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                </span>
                            @endif
                        </p>
                    </div>

                    @if (isset($mataPelajaranId) && $mataPelajaranId)
                        <a href="{{ route('siswa.mapel.tugas', $mataPelajaranId) }}"
                           class="bg-slate-800 hover:bg-slate-900 text-white font-bold px-5 py-3 rounded-xl transition">
                            Kembali
                        </a>
                    @else
                        <a href="{{ route('siswa.dashboard') }}"
                           class="bg-slate-800 hover:bg-slate-900 text-white font-bold px-5 py-3 rounded-xl transition">
                            Kembali
                        </a>
                    @endif
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-2xl">
                    {{ session('error') }}
                </div>
            @endif

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

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Informasi Tugas --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-slate-800 mb-5">
                        Instruksi Tugas
                    </h2>

                    <div class="prose max-w-none text-slate-700 mb-6">
                        {{ $tugas->instruksi ?? '-' }}
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                            <p class="text-sm text-slate-500">
                                Guru
                            </p>

                            <p class="font-bold text-slate-800 mt-1">
                                {{ $tugas->guru->name ?? '-' }}
                            </p>
                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                            <p class="text-sm text-slate-500">
                                Deadline
                            </p>

                            <p class="font-bold text-slate-800 mt-1">
                                {{ $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline)->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>
                    </div>

                    @if ($tugas->file)
                        <a href="{{ asset('storage/' . $tugas->file) }}"
                           target="_blank"
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl transition">
                            Lihat / Download File Tugas
                        </a>
                    @else
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-slate-500">
                            Tidak ada file tugas yang dilampirkan.
                        </div>
                    @endif
                </div>

                {{-- Pengumpulan Tugas --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-slate-800 mb-5">
                        Pengumpulan Tugas
                    </h2>

                    @if ($pengumpulan)
                        <div class="bg-green-50 border border-green-200 rounded-2xl p-5">
                            <h3 class="text-xl font-extrabold text-green-700 mb-5">
                                Tugas sudah dikumpulkan
                            </h3>

                            <div class="space-y-4">
                                <div class="bg-white border border-green-100 rounded-xl p-4">
                                    <p class="text-sm text-slate-500">
                                        Status
                                    </p>

                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ ucfirst($pengumpulan->status ?? 'Dikumpulkan') }}
                                    </p>
                                </div>

                                <div class="bg-white border border-green-100 rounded-xl p-4">
                                    <p class="text-sm text-slate-500">
                                        Tanggal Kumpul
                                    </p>

                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $pengumpulan->created_at ? $pengumpulan->created_at->format('d-m-Y H:i') : '-' }}
                                    </p>
                                </div>

                                <div class="bg-white border border-green-100 rounded-xl p-4">
                                    <p class="text-sm text-slate-500">
                                        Nilai
                                    </p>

                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $pengumpulan->nilai ?? 'Belum dinilai' }}
                                    </p>
                                </div>

                                <div class="bg-white border border-green-100 rounded-xl p-4">
                                    <p class="text-sm text-slate-500">
                                        Komentar
                                    </p>

                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $pengumpulan->komentar_guru ?? $pengumpulan->komentar_siswa ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            @if ($pengumpulan->file)
                                <a href="{{ asset('storage/' . $pengumpulan->file) }}"
                                   target="_blank"
                                   class="mt-5 inline-block w-full text-center bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-3 rounded-xl transition">
                                    Lihat File Jawaban
                                </a>
                            @endif
                        </div>
                    @else
                        <form action="{{ route('siswa.pengumpulan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf

                            <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">

                            @if (isset($mataPelajaranId) && $mataPelajaranId)
                                <input type="hidden" name="mata_pelajaran_id" value="{{ $mataPelajaranId }}">
                            @endif

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Upload File Jawaban
                                </label>

                                <input type="file" name="file" required
                                    class="w-full rounded-xl border border-slate-300 bg-white p-3">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Komentar Siswa
                                </label>

                                <textarea name="komentar_siswa" rows="5"
                                    placeholder="Contoh: Pak/Bu, ini jawaban tugas saya."
                                    class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('komentar_siswa') }}</textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl transition">
                                Kumpulkan Tugas
                            </button>
                        </form>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Detail Tugas</p>
                        <h1 class="text-3xl font-extrabold text-slate-800 mt-1">
                            {{ $tugas->judul }}
                        </h1>
                        <p class="text-slate-500 mt-2">
                            Kelas:
                            <span class="font-bold text-blue-700">
                                {{ $tugas->kelas->nama_kelas ?? '-' }}
                            </span>
                        </p>
                    </div>

                    <a href="{{ route('siswa.tugas.index') }}"
                        class="bg-slate-700 hover:bg-slate-800 text-white font-semibold px-5 py-2 rounded-xl">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-3">Instruksi Tugas</h2>

                    <p class="text-slate-700 leading-relaxed whitespace-pre-line mb-5">
                        {{ $tugas->instruksi ?? 'Tidak ada instruksi.' }}
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                            <p class="text-slate-500">Guru</p>
                            <p class="font-bold text-slate-800 mt-1">
                                {{ $tugas->guru->name ?? '-' }}
                            </p>
                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                            <p class="text-slate-500">Deadline</p>
                            <p class="font-bold text-slate-800 mt-1">
                                {{ $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline)->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>
                    </div>

                    @if ($tugas->file)
                        <a href="{{ asset('storage/' . $tugas->file) }}" target="_blank"
                            class="inline-block mt-5 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl">
                            Lihat / Download File Tugas
                        </a>
                    @endif
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-4">Pengumpulan Tugas</h2>

                    @if ($pengumpulan)
                        <div class="bg-green-50 border border-green-200 rounded-2xl p-5">
                            <p class="font-extrabold text-green-700 text-lg">
                                Tugas sudah dikumpulkan
                            </p>

                            <div class="space-y-3 mt-4 text-sm">
                                <div class="bg-white border border-green-100 rounded-xl p-3">
                                    <p class="text-slate-500">Status</p>
                                    <p class="font-bold text-slate-800 mt-1">{{ ucfirst($pengumpulan->status) }}</p>
                                </div>

                                <div class="bg-white border border-green-100 rounded-xl p-3">
                                    <p class="text-slate-500">Tanggal Kumpul</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $pengumpulan->created_at ? $pengumpulan->created_at->format('d-m-Y H:i') : '-' }}
                                    </p>
                                </div>

                                <div class="bg-white border border-green-100 rounded-xl p-3">
                                    <p class="text-slate-500">Nilai</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $pengumpulan->nilai ?? 'Belum dinilai' }}
                                    </p>
                                </div>

                                <div class="bg-white border border-green-100 rounded-xl p-3">
                                    <p class="text-slate-500">Komentar</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $pengumpulan->komentar ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            @if ($pengumpulan->file)
                                <a href="{{ asset('storage/' . $pengumpulan->file) }}" target="_blank"
                                    class="block w-full text-center mt-5 bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-3 rounded-xl">
                                    Lihat File Jawaban
                                </a>
                            @endif
                        </div>
                    @else
                        <form action="{{ route('siswa.pengumpulan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf

                            <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Upload File Jawaban
                                </label>

                                <input type="file" name="file" required
                                    class="block w-full text-sm text-slate-700 border border-slate-300 rounded-xl cursor-pointer bg-white p-3">

                                <p class="text-xs text-slate-500 mt-2">
                                    Upload file jawaban tugas. Maksimal 5MB.
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Komentar
                                </label>

                                <textarea name="komentar" rows="4"
                                    placeholder="Contoh: Saya sudah mengerjakan tugas ini"
                                    class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('komentar') }}</textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl transition">
                                Kumpulkan Tugas
                            </button>
                        </form>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
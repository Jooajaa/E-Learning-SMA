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

                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('guru.pengumpulan.index', ['tugas_id' => $tugas->id]) }}"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-xl">
                            Lihat Pengumpulan
                        </a>

                        <a href="{{ route('guru.tugas.edit', $tugas->id) }}"
                            class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-5 py-2 rounded-xl">
                            Edit Tugas
                        </a>

                        <a href="{{ route('guru.tugas.index') }}"
                            class="bg-slate-700 hover:bg-slate-800 text-white font-semibold px-5 py-2 rounded-xl">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-3">Instruksi Tugas</h2>
                    <p class="text-slate-700 leading-relaxed whitespace-pre-line">
                        {{ $tugas->instruksi ?? 'Tidak ada instruksi.' }}
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-4">Informasi</h2>

                    <div class="space-y-3 text-sm">
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                            <p class="text-slate-500">Deadline</p>
                            <p class="font-bold text-slate-800 mt-1">
                                {{ $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline)->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                            <p class="text-slate-500">Total Pengumpulan</p>
                            <p class="font-bold text-slate-800 mt-1">
                                {{ $tugas->pengumpulan->count() }} siswa
                            </p>
                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                            <p class="text-slate-500">File Tugas</p>
                            <p class="font-bold text-slate-800 mt-1">
                                {{ $tugas->file ? 'Ada file' : 'Tidak ada file' }}
                            </p>
                        </div>
                    </div>

                    @if ($tugas->file)
                        <a href="{{ asset('storage/' . $tugas->file) }}" target="_blank"
                            class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl mt-5">
                            Lihat / Download File
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
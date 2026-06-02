<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Detail Materi</p>
                        <h1 class="text-3xl font-extrabold text-slate-800 mt-1">
                            {{ $materi->judul }}
                        </h1>

                        <p class="text-slate-500 mt-2">
                            Kelas:
                            <span class="font-bold text-blue-700">
                                {{ $materi->kelas->nama_kelas ?? '-' }}
                            </span>
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('guru.materi.edit', $materi->id) }}"
                            class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-5 py-2 rounded-xl">
                            Edit Materi
                        </a>

                        <a href="{{ route('guru.materi.index') }}"
                            class="bg-slate-700 hover:bg-slate-800 text-white font-semibold px-5 py-2 rounded-xl">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-3">Deskripsi Materi</h2>
                    <p class="text-slate-700 leading-relaxed">
                        {{ $materi->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-4">Informasi</h2>

                    <div class="space-y-3 text-sm">
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                            <p class="text-slate-500">Status</p>
                            <p class="font-bold text-slate-800 mt-1">
                                {{ $materi->is_active ? 'Aktif' : 'Nonaktif' }}
                            </p>
                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                            <p class="text-slate-500">Guru</p>
                            <p class="font-bold text-slate-800 mt-1">
                                {{ $materi->guru->name ?? '-' }}
                            </p>
                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                            <p class="text-slate-500">Tanggal Upload</p>
                            <p class="font-bold text-slate-800 mt-1">
                                {{ $materi->created_at ? $materi->created_at->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>
                    </div>

                    @if ($materi->file)
                        <a href="{{ asset('storage/' . $materi->file) }}" target="_blank"
                            class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl mt-5">
                            Lihat / Download File
                        </a>
                    @else
                        <div class="mt-5 bg-slate-50 border border-slate-200 rounded-xl p-4 text-slate-500 text-center">
                            Tidak ada file materi.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
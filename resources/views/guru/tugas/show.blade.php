<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @php
                $judul = $tugas->judul
                    ?? $tugas->judul_tugas
                    ?? $tugas->nama_tugas
                    ?? $tugas->title
                    ?? '-';

                $deadline = $tugas->deadline
                    ?? $tugas->tanggal_deadline
                    ?? $tugas->batas_pengumpulan
                    ?? '-';

                $instruksi = $tugas->deskripsi
                    ?? $tugas->instruksi
                    ?? $tugas->keterangan
                    ?? $tugas->isi
                    ?? 'Tidak ada instruksi.';

                $file = $tugas->file
                    ?? $tugas->file_tugas
                    ?? $tugas->lampiran
                    ?? $tugas->path_file
                    ?? null;
            @endphp

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Detail Tugas
                        </h1>
                        <p class="text-gray-500 mt-1">
                            Informasi lengkap tugas yang diberikan kepada siswa.
                        </p>
                    </div>

                    <a href="{{ route('guru.tugas.index') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                        Kembali
                    </a>
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Tugas
                        </label>

                        <div class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800">
                            {{ $judul }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deadline
                        </label>

                        <div class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800">
                            {{ $deadline }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Instruksi
                        </label>

                        <div class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 min-h-[120px]">
                            {{ $instruksi }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            File Tugas
                        </label>

                        <div class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3">
                            @if ($file)
                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                    class="text-blue-600 hover:underline font-semibold">
                                    Download File Tugas
                                </a>
                            @else
                                <span class="text-gray-600">
                                    Tidak ada file
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('guru.pengumpulan.index') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                        Lihat Pengumpulan Siswa
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
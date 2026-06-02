<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Detail Kuis</p>
                        <h1 class="text-3xl font-extrabold text-slate-800 mt-1">
                            {{ $kuis->judul }}
                        </h1>

                        <p class="text-slate-500 mt-2">
                            Kelas:
                            <span class="font-bold text-blue-700">
                                {{ $kuis->kelas->nama_kelas ?? '-' }}
                            </span>
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('guru.kuis.soal.create', $kuis->id) }}"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-xl">
                            + Tambah Soal
                        </a>

                        <a href="{{ route('guru.kuis.index') }}"
                            class="bg-slate-700 hover:bg-slate-800 text-white font-semibold px-5 py-2 rounded-xl">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-3">Deskripsi Kuis</h2>
                    <p class="text-slate-700 leading-relaxed">
                        {{ $kuis->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-4">Informasi</h2>

                    <div class="space-y-3 text-sm">
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                            <p class="text-slate-500">Waktu Mulai</p>
                            <p class="font-bold text-slate-800 mt-1">
                                {{ $kuis->waktu_mulai ? \Carbon\Carbon::parse($kuis->waktu_mulai)->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                            <p class="text-slate-500">Waktu Selesai</p>
                            <p class="font-bold text-slate-800 mt-1">
                                {{ $kuis->waktu_selesai ? \Carbon\Carbon::parse($kuis->waktu_selesai)->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                            <p class="text-slate-500">Jumlah Soal</p>
                            <p class="font-bold text-slate-800 mt-1">
                                {{ $kuis->soal->count() }} soal
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h2 class="text-2xl font-bold text-slate-800">Daftar Soal</h2>
                <p class="text-slate-500 text-sm mt-1">
                    Soal yang akan dikerjakan siswa pada kuis ini.
                </p>
            </div>

            @if ($kuis->soal->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada soal untuk kuis ini.
                </div>
            @else
                <div class="space-y-5">
                    @foreach ($kuis->soal as $soal)
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <div class="flex items-start justify-between gap-3 mb-4">
                                <h3 class="text-lg font-bold text-slate-800">
                                    Soal {{ $loop->iteration }}
                                </h3>

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                    Jawaban: {{ $soal->jawaban_benar }}
                                </span>
                            </div>

                            <p class="text-slate-800 font-semibold mb-5">
                                {{ $soal->pertanyaan }}
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                <div class="border rounded-xl p-3 {{ $soal->jawaban_benar == 'A' ? 'bg-green-100 border-green-300 text-green-800' : 'bg-slate-50 border-slate-200 text-slate-700' }}">
                                    <span class="font-bold">A.</span> {{ $soal->pilihan_a }}
                                </div>

                                <div class="border rounded-xl p-3 {{ $soal->jawaban_benar == 'B' ? 'bg-green-100 border-green-300 text-green-800' : 'bg-slate-50 border-slate-200 text-slate-700' }}">
                                    <span class="font-bold">B.</span> {{ $soal->pilihan_b }}
                                </div>

                                <div class="border rounded-xl p-3 {{ $soal->jawaban_benar == 'C' ? 'bg-green-100 border-green-300 text-green-800' : 'bg-slate-50 border-slate-200 text-slate-700' }}">
                                    <span class="font-bold">C.</span> {{ $soal->pilihan_c }}
                                </div>

                                <div class="border rounded-xl p-3 {{ $soal->jawaban_benar == 'D' ? 'bg-green-100 border-green-300 text-green-800' : 'bg-slate-50 border-slate-200 text-slate-700' }}">
                                    <span class="font-bold">D.</span> {{ $soal->pilihan_d }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
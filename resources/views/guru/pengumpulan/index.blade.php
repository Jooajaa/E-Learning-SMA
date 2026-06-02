<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-purple-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-purple-100 font-semibold mb-2">Koreksi Tugas</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold">Pengumpulan Tugas</h1>
                        <p class="text-purple-100 mt-3 max-w-2xl">
                            Periksa file jawaban siswa, berikan nilai, dan tuliskan komentar penilaian.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[180px]">
                        <p class="text-purple-100 text-sm">Total Pengumpulan</p>
                        <p class="text-3xl font-extrabold mt-1">{{ $pengumpulan->count() }}</p>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            @if ($pengumpulan->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada tugas yang dikumpulkan siswa.
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach ($pengumpulan as $item)
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition">

                            <div class="flex items-start justify-between gap-3 mb-5">
                                <div>
                                    <p class="text-sm text-slate-500">Tugas</p>
                                    <h3 class="text-xl font-extrabold text-slate-800 mt-1">
                                        {{ $item->tugas->judul ?? 'Tugas' }}
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Siswa:
                                        <span class="font-semibold text-blue-700">
                                            {{ $item->siswa->name ?? '-' }}
                                        </span>
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $item->status == 'dinilai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($item->status ?? 'dikumpulkan') }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm mb-5">
                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                    <p class="text-slate-500">Kelas</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->tugas->kelas->nama_kelas ?? '-' }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                    <p class="text-slate-500">Tanggal Kumpul</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-200 mb-5">
                                <p class="text-sm text-slate-500">Komentar Siswa</p>
                                <p class="text-slate-700 mt-1">
                                    {{ $item->komentar ?? '-' }}
                                </p>
                            </div>

                            @if ($item->file)
                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                    class="inline-block mb-5 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2 rounded-xl">
                                    Lihat / Download Jawaban
                                </a>
                            @endif

                            <form action="{{ route('guru.pengumpulan.nilai', $item->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nilai</label>
                                    <input type="number" name="nilai" min="0" max="100"
                                        value="{{ old('nilai', $item->nilai) }}"
                                        class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Komentar Guru</label>
                                    <textarea name="komentar" rows="3"
                                        placeholder="Tulis komentar penilaian"
                                        class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('komentar', $item->komentar) }}</textarea>
                                </div>

                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-3 rounded-xl transition">
                                    Simpan Nilai
                                </button>
                            </form>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
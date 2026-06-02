<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-amber-600 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-amber-100 font-semibold mb-2">Evaluasi Belajar</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold">Kuis Siswa</h1>
                        <p class="text-amber-100 mt-3 max-w-2xl">
                            Kerjakan kuis yang tersedia sesuai kelas kamu dan lihat hasilnya setelah selesai.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[180px]">
                        <p class="text-amber-100 text-sm">Total Kuis</p>
                        <p class="text-3xl font-extrabold mt-1">{{ $kuis->count() }}</p>
                    </div>
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

            @if ($kuis->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada kuis untuk kelas kamu.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($kuis as $item)
                        @php
                            $sudahDikerjakan = in_array($item->id, $kuisSudahDikerjakan ?? []);
                        @endphp

                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition">
                            <div class="flex items-start justify-between gap-3 mb-5">
                                <div>
                                    <p class="text-sm text-slate-500">Judul Kuis</p>
                                    <h3 class="text-xl font-extrabold text-slate-800 mt-1">
                                        {{ $item->judul }}
                                    </h3>
                                    <p class="text-sm text-slate-500 mt-1">
                                        Guru:
                                        <span class="font-semibold text-blue-700">
                                            {{ $item->guru->name ?? '-' }}
                                        </span>
                                    </p>
                                </div>

                                @if ($sudahDikerjakan)
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                        Selesai
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                        Belum
                                    </span>
                                @endif
                            </div>

                            <p class="text-sm text-slate-600 mb-5">
                                {{ \Illuminate\Support\Str::limit($item->deskripsi ?? 'Tidak ada deskripsi.', 120) }}
                            </p>

                            <div class="grid grid-cols-2 gap-3 text-sm mb-5">
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-slate-500">Jumlah Soal</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->soal->count() }} soal
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3">
                                    <p class="text-slate-500">Status</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $sudahDikerjakan ? 'Sudah dikerjakan' : 'Belum dikerjakan' }}
                                    </p>
                                </div>
                            </div>

                            @if ($sudahDikerjakan)
                                <a href="{{ route('siswa.nilai.index') }}"
                                    class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-bold px-4 py-3 rounded-xl transition">
                                    Lihat Nilai
                                </a>
                            @else
                                <a href="{{ route('siswa.kuis.kerjakan', $item->id) }}"
                                    class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-3 rounded-xl transition">
                                    Kerjakan Kuis
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
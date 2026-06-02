<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-cyan-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <p class="text-cyan-100 font-semibold mb-2">Kehadiran Siswa</p>
                <h1 class="text-3xl md:text-4xl font-extrabold">Absensi Siswa</h1>
                <p class="text-cyan-100 mt-3 max-w-2xl">
                    Isi absensi harian dan lihat riwayat kehadiran kamu.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-1">Absensi Hari Ini</h2>
                    <p class="text-sm text-slate-500 mb-5">
                        Isi status kehadiran kamu pada hari ini.
                    </p>

                    <form action="{{ route('siswa.absensi.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Status Kehadiran</label>
                            <select name="status" required
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                                <option value="alpha">Alpha</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Keterangan</label>
                            <textarea name="keterangan" rows="4"
                                placeholder="Contoh: Hadir tepat waktu"
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan') }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl transition">
                            Kirim Absensi
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-1">Riwayat Absensi</h2>
                    <p class="text-sm text-slate-500 mb-5">
                        Daftar absensi yang sudah kamu kirim.
                    </p>

                    @if ($absensi->isEmpty())
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-8 text-center text-slate-500">
                            Belum ada riwayat absensi.
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach ($absensi as $item)
                                <div class="border border-slate-200 rounded-xl p-4 bg-slate-50 flex items-start justify-between gap-3">
                                    <div>
                                        <h3 class="font-bold text-slate-800">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                        </h3>
                                        <p class="text-sm text-slate-500 mt-1">
                                            {{ $item->keterangan ?? '-' }}
                                        </p>
                                    </div>

                                    <span class="px-3 py-1 rounded-full text-xs font-bold
                                        @if (strtolower($item->status) == 'hadir')
                                            bg-green-100 text-green-700
                                        @elseif (strtolower($item->status) == 'izin')
                                            bg-blue-100 text-blue-700
                                        @elseif (strtolower($item->status) == 'sakit')
                                            bg-yellow-100 text-yellow-700
                                        @else
                                            bg-red-100 text-red-700
                                        @endif">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-cyan-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-cyan-100 font-semibold mb-2">
                            Kehadiran Siswa
                        </p>

                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Absensi Siswa
                        </h1>

                        <p class="text-cyan-100 mt-3">
                            Isi absensi dan lihat riwayat kehadiran kamu berdasarkan mata pelajaran.
                        </p>

                        @if (isset($mapel) && $mapel)
                            <div class="mt-5 inline-flex items-center gap-2 bg-white/15 border border-white/20 px-4 py-2 rounded-xl">
                                <span class="text-cyan-100 text-sm">
                                    Mata Pelajaran:
                                </span>

                                <span class="font-bold">
                                    {{ $mapel->nama_mapel ?? $mapel->nama_mata_pelajaran ?? '-' }}
                                </span>
                            </div>
                        @endif
                    </div>

                    @if (request('mata_pelajaran_id'))
                        <a href="{{ route('siswa.mapel.show', request('mata_pelajaran_id')) }}"
                           class="bg-white/15 hover:bg-white/25 border border-white/20 text-white font-bold px-5 py-3 rounded-xl transition">
                            Kembali
                        </a>
                    @else
                        <a href="{{ route('siswa.dashboard') }}"
                           class="bg-white/15 hover:bg-white/25 border border-white/20 text-white font-bold px-5 py-3 rounded-xl transition">
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

            @if (!request('mata_pelajaran_id'))
                <div class="mb-6 p-4 bg-yellow-100 border border-yellow-300 text-yellow-700 rounded-2xl">
                    Absensi sebaiknya dibuka dari halaman mata pelajaran agar tersimpan sesuai mapel.
                    Silakan kembali ke dashboard, pilih mata pelajaran, lalu klik Absensi.
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- FORM ABSENSI --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-slate-800">
                        Absensi Hari Ini
                    </h2>

                    <p class="text-slate-500 text-sm mt-1">
                        Isi status kehadiran kamu pada hari ini.
                    </p>

                    @if (isset($sudahAbsenHariIni) && $sudahAbsenHariIni)
                        <div class="mt-6 bg-green-50 border border-green-200 text-green-700 rounded-2xl p-5 text-center">
                            <div class="text-3xl mb-2">✅</div>

                            <p class="font-bold">
                                Kamu sudah mengisi absensi hari ini.
                            </p>

                            <p class="text-sm mt-1">
                                Riwayat absensi dapat dilihat di sebelah kanan.
                            </p>
                        </div>
                    @else
                        <form action="{{ route('siswa.absensi.store') }}" method="POST" class="mt-6 space-y-5">
                            @csrf

                            <input type="hidden" name="mata_pelajaran_id" value="{{ request('mata_pelajaran_id') }}">

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Status Kehadiran
                                </label>

                                <select name="status" required
                                    class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                                    <option value="Hadir" {{ old('status') == 'Hadir' ? 'selected' : '' }}>
                                        Hadir
                                    </option>

                                    <option value="Izin" {{ old('status') == 'Izin' ? 'selected' : '' }}>
                                        Izin
                                    </option>

                                    <option value="Sakit" {{ old('status') == 'Sakit' ? 'selected' : '' }}>
                                        Sakit
                                    </option>

                                    <option value="Alpha" {{ old('status') == 'Alpha' ? 'selected' : '' }}>
                                        Alpha
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Keterangan
                                </label>

                                <textarea name="keterangan" rows="5"
                                    placeholder="Contoh: Hadir tepat waktu"
                                    class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan') }}</textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl transition">
                                Kirim Absensi
                            </button>
                        </form>
                    @endif
                </div>

                {{-- RIWAYAT ABSENSI --}}
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">
                                Riwayat Absensi
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Daftar absensi yang sudah kamu kirim.
                            </p>
                        </div>

                        @if (isset($mapel) && $mapel)
                            <div class="bg-cyan-50 text-cyan-700 px-4 py-2 rounded-xl font-bold text-sm">
                                {{ $mapel->nama_mapel ?? $mapel->nama_mata_pelajaran ?? '-' }}
                            </div>
                        @endif
                    </div>

                    @if (!isset($absensi) || $absensi->isEmpty())
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 text-center text-slate-500">
                            Belum ada riwayat absensi untuk mata pelajaran ini.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-200">
                                <thead>
                                    <tr class="bg-slate-50">
                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            No
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Tanggal
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Mata Pelajaran
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Status
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                            Keterangan
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-slate-200">
                                    @foreach ($absensi as $item)
                                        @php
                                            $status = strtolower($item->status);
                                        @endphp

                                        <tr class="hover:bg-slate-50">
                                            <td class="px-4 py-4 text-sm text-slate-600">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-4 py-4 text-sm font-semibold text-slate-800">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                            </td>

                                            <td class="px-4 py-4 text-sm text-slate-600">
                                                {{ $item->mataPelajaran->nama_mapel ?? $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                            </td>

                                            <td class="px-4 py-4 text-sm">
                                                @if ($status == 'hadir')
                                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                                        Hadir
                                                    </span>
                                                @elseif ($status == 'izin')
                                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                                        Izin
                                                    </span>
                                                @elseif ($status == 'sakit')
                                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                                        Sakit
                                                    </span>
                                                @elseif ($status == 'alpha' || $status == 'alpa')
                                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                                        Alpha
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold">
                                                        {{ $item->status }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="px-4 py-4 text-sm text-slate-600">
                                                {{ $item->keterangan ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
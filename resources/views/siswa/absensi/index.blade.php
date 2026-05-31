<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Absensi Siswa
                </h1>
                <p class="text-gray-500 mt-1">
                    Isi absensi harian dan lihat riwayat kehadiran kamu.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">
                            Absensi Hari Ini
                        </h2>

                        <p class="text-sm text-gray-500 mb-5">
                            Tanggal: {{ now()->format('d-m-Y') }}
                        </p>

                        @if ($absensiHariIni)
                            <div class="p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                                <p class="font-semibold">
                                    Kamu sudah absen hari ini.
                                </p>

                                <p class="mt-2">
                                    Status: <span class="font-bold">{{ $absensiHariIni->status }}</span>
                                </p>

                                <p>
                                    Keterangan: {{ $absensiHariIni->keterangan ?? '-' }}
                                </p>
                            </div>
                        @else
                            <form action="{{ route('siswa.absensi.store') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Status Kehadiran
                                    </label>

                                    <select name="status"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Hadir">Hadir</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Alpha">Alpha</option>
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Keterangan
                                    </label>

                                    <textarea name="keterangan" rows="3"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Contoh: Hadir tepat waktu / izin karena keperluan keluarga"></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                    Kirim Absensi
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-5">
                            Riwayat Absensi
                        </h2>

                        <div class="space-y-4">
                            @forelse ($absensi as $item)
                                <div class="border border-gray-200 rounded-lg p-4 flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="font-bold text-gray-800">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                        </h3>

                                        <p class="text-sm text-gray-600 mt-1">
                                            Keterangan: {{ $item->keterangan ?? '-' }}
                                        </p>
                                    </div>

                                    <span class="px-3 py-1 text-xs rounded-full font-semibold
                                        @if ($item->status == 'Hadir') bg-green-100 text-green-700
                                        @elseif ($item->status == 'Izin') bg-blue-100 text-blue-700
                                        @elseif ($item->status == 'Sakit') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700
                                        @endif">
                                        {{ $item->status }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-center text-gray-500 py-8">
                                    Belum ada riwayat absensi.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
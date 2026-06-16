<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Kalender Akademik</h1>
                <p class="text-gray-500 mt-1">
                    Informasi kegiatan sekolah, ujian, libur akademik, dan libur nasional.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-5 bg-green-100 border border-green-300 text-green-700 rounded-xl p-4">
                    {{ session('success') }}
                </div>
            @endif

            @role('admin')
                <div class="mb-6 bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Tambah Kalender Sekolah</h2>

                    <form method="POST" action="{{ route('kalender.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Kegiatan</label>
                                <input type="text" name="judul" value="{{ old('judul') }}"
                                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                       required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis</label>
                                <select name="jenis"
                                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="event">Event</option>
                                    <option value="ujian">Ujian</option>
                                    <option value="libur">Libur</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                       required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                                <textarea name="keterangan" rows="3"
                                          class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>

                        <button type="submit"
                                class="mt-4 px-5 py-2.5 bg-blue-700 text-white rounded-lg font-semibold hover:bg-blue-800">
                            Simpan Kalender
                        </button>
                    </form>
                </div>

                <form method="GET"
                      action="{{ url()->current() }}"
                      class="mb-6 bg-white border border-gray-200 rounded-xl p-5 shadow-sm">

                    <div class="flex flex-col sm:flex-row sm:items-end gap-4">
                        <div>
                            <label for="tahun" class="block text-sm font-semibold text-gray-700 mb-2">
                                Pilih Tahun Kalender
                            </label>

                            <select name="tahun" id="tahun"
                                    class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                @for ($i = now()->year - 2; $i <= now()->year + 3; $i++)
                                    <option value="{{ $i }}" @selected((int) $tahun === $i)>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit"
                                class="px-5 py-2.5 bg-blue-700 text-white rounded-lg font-semibold hover:bg-blue-800">
                            Update Kalender
                        </button>
                    </div>
                </form>
            @endrole

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Kalender dari Sekolah</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($kalender as $item)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">
                                        {{ $item->judul }}
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}

                                        @if (!empty($item->tanggal_selesai))
                                            - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                        @endif
                                    </p>
                                </div>

                                <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                                    {{ ucfirst($item->jenis) }}
                                </span>
                            </div>

                            <p class="text-gray-600">
                                {{ $item->keterangan ?? '-' }}
                            </p>

                            @role('admin')
                                <form action="{{ route('kalender.destroy', $item->id) }}"
                                      method="POST"
                                      class="mt-4"
                                      onsubmit="return confirm('Yakin ingin menghapus kalender ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            @endrole
                        </div>
                    @empty
                        <div class="col-span-2 bg-white rounded-xl border border-gray-200 p-8 text-center text-gray-500">
                            Belum ada kegiatan akademik dari sekolah.
                        </div>
                    @endforelse
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Libur Nasional Otomatis dari API
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Data ini diambil dari API eksternal.
                        </p>
                    </div>

                    <span class="px-4 py-2 rounded-xl bg-blue-100 text-blue-700 text-sm font-bold">
                        Tahun {{ $tahun ?? date('Y') }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($liburNasional as $item)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-xl font-bold text-gray-800">
                                {{ $item['nama'] }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ \Carbon\Carbon::parse($item['tanggal'])->format('d M Y') }}
                            </p>

                            <p class="text-gray-600 mt-3">
                                Data hari libur nasional ini diambil otomatis dari API eksternal.
                            </p>
                        </div>
                    @empty
                        <div class="col-span-2 bg-white rounded-xl border border-gray-200 p-8 text-center text-gray-500">
                            Data libur nasional dari API belum tersedia.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

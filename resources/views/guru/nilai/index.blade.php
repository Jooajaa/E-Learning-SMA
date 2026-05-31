<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Nilai Guru
                </h1>
                <p class="text-gray-500 mt-1">
                    Lihat dan kelola data nilai siswa dari kuis dan tugas.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">
                    Nilai Kuis
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($nilaiKuis as $item)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-800">
                                    Siswa ID: {{ $item->siswa_id }}
                                </h3>

                                <span class="px-3 py-1 rounded-full text-sm font-bold
                                    {{ $item->nilai >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item->nilai }}
                                </span>
                            </div>

                            <div class="space-y-2 text-sm text-gray-600">
                                <p>
                                    <span class="font-semibold">Guru ID:</span>
                                    {{ $item->guru_id ?? '-' }}
                                </p>

                                <p>
                                    <span class="font-semibold">Kuis ID:</span>
                                    {{ $item->kuis_id ?? '-' }}
                                </p>

                                <p>
                                    <span class="font-semibold">Keterangan:</span>
                                    {{ $item->keterangan ?? '-' }}
                                </p>

                                <p>
                                    <span class="font-semibold">Tanggal:</span>
                                    {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                            <p class="text-gray-500">
                                Belum ada nilai kuis.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">
                    Nilai Tugas
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($nilaiTugas as $item)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-800">
                                    {{ $item->tugas->judul ?? 'Tugas tidak ditemukan' }}
                                </h3>

                                <span class="px-3 py-1 rounded-full text-sm font-bold
                                    {{ $item->nilai >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item->nilai }}
                                </span>
                            </div>

                            <div class="space-y-2 text-sm text-gray-600">
                                <p>
                                    <span class="font-semibold">Siswa:</span>
                                    {{ $item->siswa->name ?? 'Siswa tidak ditemukan' }}
                                </p>

                                <p>
                                    <span class="font-semibold">Status:</span>
                                    {{ $item->status ?? 'Dikumpulkan' }}
                                </p>

                                <p>
                                    <span class="font-semibold">Komentar:</span>
                                    {{ $item->komentar ?? '-' }}
                                </p>

                                <p>
                                    <span class="font-semibold">Tanggal Kumpul:</span>
                                    {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                                </p>
                            </div>

                            <div class="mt-5">
                                <a href="{{ route('guru.pengumpulan.index') }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                    Lihat Pengumpulan
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                            <p class="text-gray-500">
                                Belum ada nilai tugas.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
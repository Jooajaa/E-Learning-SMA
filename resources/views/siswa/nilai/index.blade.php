<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Nilai Siswa
                </h1>
                <p class="text-gray-500 mt-1">
                    Lihat hasil nilai kuis dan tugas yang sudah dikerjakan.
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
                                    Kuis ID: {{ $item->kuis_id ?? '-' }}
                                </h3>

                                <span class="px-3 py-1 rounded-full text-sm font-bold
                                    {{ $item->nilai >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item->nilai }}
                                </span>
                            </div>

                            <div class="space-y-2 text-sm text-gray-600">
                                <p>
                                    {{ $item->keterangan ?? 'Nilai kuis' }}
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
                                    <span class="font-semibold">Status:</span>
                                    {{ $item->status ?? 'Dikumpulkan' }}
                                </p>

                                <p>
                                    <span class="font-semibold">Komentar Guru:</span>
                                    {{ $item->komentar ?? '-' }}
                                </p>

                                <p>
                                    <span class="font-semibold">Tanggal Kumpul:</span>
                                    {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                                </p>
                            </div>

                            <div class="mt-5">
                                <a href="{{ route('siswa.tugas.index') }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                    Lihat Tugas
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
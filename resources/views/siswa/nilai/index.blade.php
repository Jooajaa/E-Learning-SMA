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

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($nilai as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-bold text-gray-800">
                                Kuis ID: {{ $item->kuis_id }}
                            </h2>

                            <span class="px-3 py-1 rounded-full text-sm font-bold
                                {{ $item->nilai >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $item->nilai }}
                            </span>
                        </div>

                        <p class="text-gray-600 mb-4">
                            {{ $item->keterangan }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Tanggal:
                            {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                        </p>
                    </div>
                @empty
                    <div class="col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-gray-500">
                            Belum ada data nilai.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
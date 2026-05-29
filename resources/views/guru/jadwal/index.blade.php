<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Jadwal Guru
                </h1>
                <p class="text-gray-500 mt-1">
                    Lihat jadwal mengajar berdasarkan hari, jam, kelas, dan mata pelajaran.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($jadwal as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-gray-800">
                                {{ $item->hari }}
                            </h2>

                            <span class="px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-700">
                                {{ $item->kelas ?? '-' }}
                            </span>
                        </div>

                        <p class="text-lg font-semibold text-gray-700 mb-4">
                            {{ $item->mata_pelajaran }}
                        </p>

                        <div class="space-y-2 text-sm text-gray-600">
                            <p>
                                <span class="font-semibold">Jam Mulai:</span>
                                {{ $item->jam_mulai }}
                            </p>

                            <p>
                                <span class="font-semibold">Jam Selesai:</span>
                                {{ $item->jam_selesai }}
                            </p>

                            <p>
                                <span class="font-semibold">Guru ID:</span>
                                {{ $item->guru_id ?? '-' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-gray-500">
                            Belum ada data jadwal.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
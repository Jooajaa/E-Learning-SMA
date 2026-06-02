<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Mata Pelajaran
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-1">Nama Mapel</label>
                        <input type="text"
                               name="nama_mapel"
                               value="{{ old('nama_mapel', $mapel->nama_mapel) }}"
                               class="w-full border rounded px-3 py-2">
                        @error('nama_mapel')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Kode Mapel</label>
                        <input type="text"
                               name="kode_mapel"
                               value="{{ old('kode_mapel', $mapel->kode_mapel) }}"
                               class="w-full border rounded px-3 py-2">
                        @error('kode_mapel')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">SKS / Jam</label>
                        <input type="number"
                               name="sks"
                               value="{{ old('sks', $mapel->sks) }}"
                               class="w-full border rounded px-3 py-2">
                        @error('sks')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                            Update
                        </button>

                        <a href="{{ route('admin.mapel.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

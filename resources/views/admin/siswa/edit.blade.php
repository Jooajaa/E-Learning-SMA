<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Siswa
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-1">Nama</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $siswa->name) }}"
                               class="w-full border rounded px-3 py-2">
                        @error('name')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">NIS</label>
                        <input type="text"
                               name="nis"
                               value="{{ old('nis', $siswa->nis) }}"
                               class="w-full border rounded px-3 py-2">
                        @error('nis')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', $siswa->email) }}"
                               class="w-full border rounded px-3 py-2">
                        @error('email')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Password</label>
                        <input type="password"
                               name="password"
                               class="w-full border rounded px-3 py-2"
                               placeholder="Kosongkan jika tidak ingin mengubah password">
                        @error('password')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Status</label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif" {{ old('status', $siswa->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $siswa->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                            Update
                        </button>

                        <a href="{{ route('admin.siswa.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

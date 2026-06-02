<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Kelas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('admin.kelas.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded">
                    Tambah Kelas
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Nama Kelas</th>
                            <th class="border px-4 py-2">Tingkat</th>
                            <th class="border px-4 py-2">Jurusan</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelas as $item)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $item->nama_kelas }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $item->tingkat }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $item->jurusan }}
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('admin.kelas.edit', $item->id) }}"
                                       class="text-blue-600">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.kelas.destroy', $item->id) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 ml-2">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border px-4 py-2 text-center">
                                    Belum ada data kelas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $kelas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

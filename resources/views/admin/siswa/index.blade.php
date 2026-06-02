<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Siswa
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
                <a href="{{ route('admin.siswa.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded">
                    Tambah Siswa
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">NIS</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $item)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $item->name }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $item->nis }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $item->email }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ ucfirst($item->status) }}
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('admin.siswa.edit', $item->id) }}"
                                       class="text-blue-600">
                                        Edit
                                    </a>

                                    <a href="{{ route('admin.reset-password.edit', $item->id) }}"
                                       class="text-orange-600 ml-2">
                                        Reset Password
                                    </a>

                                    <form action="{{ route('admin.siswa.destroy', $item->id) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Yakin ingin menonaktifkan siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 ml-2">
                                            Nonaktifkan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border px-4 py-2 text-center">
                                    Belum ada data siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $siswa->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Import Data Siswa dan Guru
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-bold mb-4">Import Data Siswa</h3>

                    <p class="mb-3 text-sm text-gray-600">
                        Format kolom file: nama, email, nis, status
                    </p>

                    <form action="{{ route('admin.import.siswa') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block mb-1">File Siswa</label>
                            <input type="file"
                                   name="file_siswa"
                                   class="w-full border rounded px-3 py-2">

                            @error('file_siswa')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                            Import Siswa
                        </button>
                    </form>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-bold mb-4">Import Data Guru</h3>

                    <p class="mb-3 text-sm text-gray-600">
                        Format kolom file: nama, email, nip, status
                    </p>

                    <form action="{{ route('admin.import.guru') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block mb-1">File Guru</label>
                            <input type="file"
                                   name="file_guru"
                                   class="w-full border rounded px-3 py-2">

                            @error('file_guru')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                            Import Guru
                        </button>
                    </form>
                </div>

            </div>

            <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-bold mb-3">Catatan Format File</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-semibold mb-2">Format Siswa</h4>
                        <table class="w-full border">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border px-3 py-2">nama</th>
                                    <th class="border px-3 py-2">email</th>
                                    <th class="border px-3 py-2">nis</th>
                                    <th class="border px-3 py-2">status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-3 py-2">Budi Santoso</td>
                                    <td class="border px-3 py-2">budi@gmail.com</td>
                                    <td class="border px-3 py-2">12345</td>
                                    <td class="border px-3 py-2">aktif</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-2">Format Guru</h4>
                        <table class="w-full border">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border px-3 py-2">nama</th>
                                    <th class="border px-3 py-2">email</th>
                                    <th class="border px-3 py-2">nip</th>
                                    <th class="border px-3 py-2">status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-3 py-2">Pak Andi</td>
                                    <td class="border px-3 py-2">andi@gmail.com</td>
                                    <td class="border px-3 py-2">98765</td>
                                    <td class="border px-3 py-2">aktif</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <p class="mt-4 text-sm text-gray-600">
                    Password default hasil import adalah <strong>password</strong>.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>

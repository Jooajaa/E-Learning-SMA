<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Penugasan Siswa dan Guru
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="font-bold mb-4">Penugasan Siswa ke Kelas</h3>

                    <form action="{{ route('admin.penugasan.siswa-kelas') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="block mb-1">Siswa</label>
                            <select name="siswa_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($siswa as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->nis }}</option>
                                @endforeach
                            </select>
                            @error('siswa_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="block mb-1">Kelas</label>
                            <select name="kelas_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="block mb-1">Tahun Ajaran</label>
                            <input type="text"
                                   name="tahun_ajaran"
                                   value="{{ old('tahun_ajaran', '2026/2027') }}"
                                   class="w-full border rounded px-3 py-2"
                                   placeholder="Contoh: 2026/2027">
                            @error('tahun_ajaran')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="px-4 py-2 bg-blue-600 text-white rounded">
                            Simpan
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="font-bold mb-4">Penugasan Guru ke Mapel</h3>

                    <form action="{{ route('admin.penugasan.guru-mapel') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="block mb-1">Guru</label>
                            <select name="guru_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->nip }}</option>
                                @endforeach
                            </select>
                            @error('guru_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="block mb-1">Mata Pelajaran</label>
                            <select name="mata_pelajaran_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Mapel --</option>
                                @foreach ($mapel as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_mapel }}</option>
                                @endforeach
                            </select>
                            @error('mata_pelajaran_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="px-4 py-2 bg-blue-600 text-white rounded">
                            Simpan
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="font-bold mb-4">Penugasan Guru ke Kelas</h3>

                    <form action="{{ route('admin.penugasan.guru-kelas') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="block mb-1">Guru</label>
                            <select name="guru_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->nip }}</option>
                                @endforeach
                            </select>
                            @error('guru_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="block mb-1">Kelas</label>
                            <select name="kelas_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="block mb-1">Mata Pelajaran</label>
                            <select name="mata_pelajaran_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Mapel --</option>
                                @foreach ($mapel as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_mapel }}</option>
                                @endforeach
                            </select>
                            @error('mata_pelajaran_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="px-4 py-2 bg-blue-600 text-white rounded">
                            Simpan
                        </button>
                    </form>
                </div>

            </div>

            <div class="mt-6 bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="font-bold mb-4">Daftar Siswa per Kelas</h3>

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Siswa</th>
                            <th class="border px-4 py-2">Kelas</th>
                            <th class="border px-4 py-2">Tahun Ajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswaKelas as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $item->siswa->name ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $item->tahun_ajaran }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border px-4 py-2 text-center">
                                    Belum ada penugasan siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="font-bold mb-4">Daftar Guru dan Mata Pelajaran</h3>

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Guru</th>
                            <th class="border px-4 py-2">Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($guruMapel as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $item->guru->name ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $item->mataPelajaran->nama_mapel ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="border px-4 py-2 text-center">
                                    Belum ada penugasan guru-mapel.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="font-bold mb-4">Daftar Guru per Kelas</h3>

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Guru</th>
                            <th class="border px-4 py-2">Kelas</th>
                            <th class="border px-4 py-2">Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($guruKelas as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $item->guru->name ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $item->mataPelajaran->nama_mapel ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border px-4 py-2 text-center">
                                    Belum ada penugasan guru-kelas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

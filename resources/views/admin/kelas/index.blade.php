<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-blue-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-blue-100 font-semibold mb-2">Manajemen Akademik</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Data Kelas
                        </h1>
                        <p class="text-blue-100 mt-3 max-w-2xl">
                            Kelola daftar kelas yang digunakan dalam LMS, seperti IPA 1, IPA 2, IPS 1, dan kelas lainnya.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[180px]">
                        <p class="text-blue-100 text-sm">Total Kelas</p>
                        <p class="text-3xl font-extrabold mt-1">{{ $kelas->count() }}</p>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-2xl">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800">
                        Tambah Kelas
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 mb-5">
                        Masukkan data kelas baru.
                    </p>

                    <form action="{{ route('admin.kelas.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Nama Kelas
                            </label>
                            <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}"
                                placeholder="Contoh: IPA 1"
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Tingkat
                            </label>
                            <input type="text" name="tingkat" value="{{ old('tingkat') }}"
                                placeholder="Contoh: X / XI / XII"
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Jurusan
                            </label>
                            <input type="text" name="jurusan" value="{{ old('jurusan') }}"
                                placeholder="Contoh: IPA"
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-sm transition">
                            Simpan Kelas
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-2">
                    @if ($kelas->isEmpty())
                        <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                            Belum ada data kelas.
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @foreach ($kelas as $item)
                                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition">
                                    <div class="flex items-start justify-between gap-3 mb-4">
                                        <div>
                                            <p class="text-sm text-slate-500">Nama Kelas</p>
                                            <h3 class="text-2xl font-extrabold text-slate-800 mt-1">
                                                {{ $item->nama_kelas }}
                                            </h3>
                                        </div>

                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                            Kelas
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3 text-sm mb-5">
                                        <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                            <p class="text-slate-500">Tingkat</p>
                                            <p class="font-bold text-slate-800 mt-1">{{ $item->tingkat ?? '-' }}</p>
                                        </div>

                                        <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                            <p class="text-slate-500">Jurusan</p>
                                            <p class="font-bold text-slate-800 mt-1">{{ $item->jurusan ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <details class="mb-3">
                                        <summary class="cursor-pointer text-blue-700 font-bold">
                                            Edit Kelas
                                        </summary>

                                        <form action="{{ route('admin.kelas.update', $item->id) }}" method="POST" class="mt-4 space-y-3">
                                            @csrf
                                            @method('PUT')

                                            <input type="text" name="nama_kelas" value="{{ $item->nama_kelas }}"
                                                class="w-full rounded-xl border-slate-300 shadow-sm" required>

                                            <input type="text" name="tingkat" value="{{ $item->tingkat }}"
                                                class="w-full rounded-xl border-slate-300 shadow-sm">

                                            <input type="text" name="jurusan" value="{{ $item->jurusan }}"
                                                class="w-full rounded-xl border-slate-300 shadow-sm">

                                            <button type="submit"
                                                class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-4 py-2 rounded-xl">
                                                Update
                                            </button>
                                        </form>
                                    </details>

                                    <form action="{{ route('admin.kelas.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-xl">
                                            Hapus Kelas
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
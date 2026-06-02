<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-blue-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-blue-100 font-semibold mb-2">Manajemen Akademik</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Penugasan Akademik
                        </h1>
                        <p class="text-blue-100 mt-3 max-w-2xl">
                            Atur relasi siswa, guru, kelas, dan mata pelajaran agar materi, tugas, kuis, nilai, dan jadwal tidak tercampur antar kelas.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[220px]">
                        <p class="text-blue-100 text-sm">Status Sistem</p>
                        <p class="text-2xl font-bold mt-1">Terhubung</p>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-2xl">
                    {{ session('error') }}
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

            {{-- FORM PENUGASAN --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                {{-- Siswa ke Kelas --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="mb-5">
                        <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-bold mb-4">
                            SK
                        </div>
                        <h2 class="text-xl font-bold text-slate-800">
                            Siswa ke Kelas
                        </h2>
                        <p class="text-sm text-slate-500 mt-1">
                            Tentukan siswa masuk ke kelas tertentu.
                        </p>
                    </div>

                    <form action="{{ route('admin.penugasan.siswa-kelas') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Siswa</label>
                            <select name="siswa_id" required
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($siswa as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }} {{ $item->nis ? '- ' . $item->nis : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Kelas</label>
                            <select name="kelas_id" required
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran', '2026/2027') }}"
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Contoh: 2026/2027" required>
                        </div>

                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition">
                            Simpan Penugasan
                        </button>
                    </form>
                </div>

                {{-- Guru ke Mapel --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="mb-5">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold mb-4">
                            GM
                        </div>
                        <h2 class="text-xl font-bold text-slate-800">
                            Guru ke Mapel
                        </h2>
                        <p class="text-sm text-slate-500 mt-1">
                            Tentukan mata pelajaran yang diajar guru.
                        </p>
                    </div>

                    <form action="{{ route('admin.penugasan.guru-mapel') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Guru</label>
                            <select name="guru_id" required
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }} {{ $item->nip ? '- ' . $item->nip : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Mata Pelajaran</label>
                            <select name="mata_pelajaran_id" required
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach ($mapel as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition">
                            Simpan Penugasan
                        </button>
                    </form>
                </div>

                {{-- Guru ke Kelas --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="mb-5">
                        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold mb-4">
                            GK
                        </div>
                        <h2 class="text-xl font-bold text-slate-800">
                            Guru ke Kelas
                        </h2>
                        <p class="text-sm text-slate-500 mt-1">
                            Tentukan guru mengajar mapel pada kelas tertentu.
                        </p>
                    </div>

                    <form action="{{ route('admin.penugasan.guru-kelas') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Guru</label>
                            <select name="guru_id" required
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Kelas</label>
                            <select name="kelas_id" required
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Mata Pelajaran</label>
                            <select name="mata_pelajaran_id" required
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach ($mapel as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-xl transition">
                            Simpan Penugasan
                        </button>
                    </form>
                </div>

            </div>

            {{-- DAFTAR DATA --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Daftar Siswa per Kelas --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-1">
                        Siswa per Kelas
                    </h2>
                    <p class="text-sm text-slate-500 mb-5">
                        Daftar siswa yang sudah ditempatkan ke kelas.
                    </p>

                    @if ($siswaKelas->isEmpty())
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 text-center text-slate-500">
                            Belum ada penugasan siswa.
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach ($siswaKelas as $item)
                                <div class="border border-slate-200 rounded-xl p-4 bg-slate-50">
                                    <h3 class="font-bold text-slate-800">
                                        {{ $item->siswa->name ?? '-' }}
                                    </h3>
                                    <p class="text-sm text-slate-600 mt-1">
                                        Kelas:
                                        <span class="font-semibold text-blue-700">
                                            {{ $item->kelas->nama_kelas ?? '-' }}
                                        </span>
                                    </p>
                                    <p class="text-sm text-slate-500">
                                        Tahun Ajaran: {{ $item->tahun_ajaran ?? '-' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Daftar Guru Mapel --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-1">
                        Guru dan Mapel
                    </h2>
                    <p class="text-sm text-slate-500 mb-5">
                        Daftar mata pelajaran yang diajar guru.
                    </p>

                    @if ($guruMapel->isEmpty())
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 text-center text-slate-500">
                            Belum ada guru mapel.
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach ($guruMapel as $item)
                                <div class="border border-slate-200 rounded-xl p-4 bg-slate-50">
                                    <h3 class="font-bold text-slate-800">
                                        {{ $item->guru->name ?? '-' }}
                                    </h3>
                                    <p class="text-sm text-slate-600 mt-1">
                                        Mapel:
                                        <span class="font-semibold text-blue-700">
                                            {{ $item->mataPelajaran->nama_mapel ?? $item->mapel->nama_mapel ?? '-' }}
                                        </span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Daftar Guru Kelas --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-1">
                        Guru Mengajar Kelas
                    </h2>
                    <p class="text-sm text-slate-500 mb-5">
                        Daftar guru, kelas, dan mapel yang diajar.
                    </p>

                    @if ($guruKelas->isEmpty())
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 text-center text-slate-500">
                            Belum ada guru kelas.
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach ($guruKelas as $item)
                                <div class="border border-slate-200 rounded-xl p-4 bg-slate-50">
                                    <h3 class="font-bold text-slate-800">
                                        {{ $item->guru->name ?? '-' }}
                                    </h3>

                                    <p class="text-sm text-slate-600 mt-1">
                                        Kelas:
                                        <span class="font-semibold text-blue-700">
                                            {{ $item->kelas->nama_kelas ?? '-' }}
                                        </span>
                                    </p>

                                    <p class="text-sm text-slate-600">
                                        Mapel:
                                        <span class="font-semibold text-blue-700">
                                            {{ $item->mataPelajaran->nama_mapel ?? $item->mapel->nama_mapel ?? '-' }}
                                        </span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
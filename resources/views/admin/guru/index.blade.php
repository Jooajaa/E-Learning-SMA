<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-amber-600 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-amber-100 font-semibold mb-2">Manajemen Pengguna</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Data Guru
                        </h1>
                        <p class="text-amber-100 mt-3 max-w-2xl">
                            Kelola akun guru, data NIP, status akun, dan akses pengajar ke LMS SMA.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[180px]">
                        <p class="text-amber-100 text-sm">Total Guru</p>
                        <p class="text-3xl font-extrabold mt-1">{{ $guru->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Daftar Guru</h2>
                    <p class="text-slate-500 text-sm mt-1">
                        Tambah, edit, atau hapus data guru.
                    </p>
                </div>

                <a href="{{ route('admin.guru.create') }}"
                    class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl shadow-sm transition">
                    + Tambah Guru
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            @if ($guru->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada data guru.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($guru as $item)
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition">
                            <div class="flex items-start justify-between gap-3 mb-5">
                                <div>
                                    <p class="text-sm text-slate-500">Nama Guru</p>
                                    <h3 class="text-xl font-extrabold text-slate-800 mt-1">
                                        {{ $item->name }}
                                    </h3>
                                    <p class="text-sm text-slate-500 mt-1">
                                        {{ $item->email }}
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ ($item->status ?? 'aktif') == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($item->status ?? 'aktif') }}
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-3 text-sm mb-5">
                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                    <p class="text-slate-500">NIP</p>
                                    <p class="font-bold text-slate-800 mt-1">{{ $item->nip ?? '-' }}</p>
                                </div>

                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                    <p class="text-slate-500">Role</p>
                                    <p class="font-bold text-slate-800 mt-1">Guru</p>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('admin.guru.edit', $item->id) }}"
                                    class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-white font-semibold px-4 py-2 rounded-xl transition">
                                    Edit
                                </a>

                                <a href="{{ route('admin.reset-password.edit', $item->id) }}"
                                    class="flex-1 text-center bg-slate-700 hover:bg-slate-800 text-white font-semibold px-4 py-2 rounded-xl transition">
                                    Reset
                                </a>
                            </div>

                            <form action="{{ route('admin.guru.destroy', $item->id) }}" method="POST"
                                class="mt-2"
                                onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-xl transition">
                                    Hapus Guru
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
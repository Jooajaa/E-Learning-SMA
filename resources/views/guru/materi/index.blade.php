<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-blue-700 to-indigo-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-blue-100 font-semibold mb-2">Pembelajaran Guru</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold">Materi Pembelajaran</h1>
                        <p class="text-blue-100 mt-3 max-w-2xl">
                            Kelola materi pembelajaran berdasarkan kelas yang kamu ajar.
                        </p>
                    </div>

                    <div class="bg-white/15 border border-white/20 rounded-2xl p-5 min-w-[180px]">
                        <p class="text-blue-100 text-sm">Total Materi</p>
                        <p class="text-3xl font-extrabold mt-1">{{ $materi->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Daftar Materi</h2>
                    <p class="text-slate-500 text-sm mt-1">
                        Tambahkan materi agar siswa dapat belajar sesuai kelasnya.
                    </p>
                </div>

                <a href="{{ route('guru.materi.create') }}"
                    class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-xl shadow-sm transition">
                    + Tambah Materi
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            @if ($materi->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 shadow-sm">
                    Belum ada materi pembelajaran.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($materi as $item)
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition">

                            <div class="flex items-start justify-between gap-3 mb-5">
                                <div>
                                    <p class="text-sm text-slate-500">Judul Materi</p>
                                    <h3 class="text-xl font-extrabold text-slate-800 mt-1">
                                        {{ $item->judul }}
                                    </h3>
                                    <p class="text-sm text-slate-500 mt-1">
                                        Kelas:
                                        <span class="font-semibold text-blue-700">
                                            {{ $item->kelas->nama_kelas ?? 'Belum dipilih' }}
                                        </span>
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>

                            <p class="text-sm text-slate-600 mb-5">
                                {{ \Illuminate\Support\Str::limit($item->deskripsi ?? 'Tidak ada deskripsi.', 120) }}
                            </p>

                            <div class="space-y-3 text-sm mb-5">
                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                    <p class="text-slate-500">File Materi</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->file ? 'Ada file' : 'Tidak ada file' }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                                    <p class="text-slate-500">Tanggal Upload</p>
                                    <p class="font-bold text-slate-800 mt-1">
                                        {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('guru.materi.show', $item->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold px-4 py-2 rounded-xl transition">
                                    Detail
                                </a>

                                <a href="{{ route('guru.materi.edit', $item->id) }}"
                                    class="bg-amber-500 hover:bg-amber-600 text-white text-center font-semibold px-4 py-2 rounded-xl transition">
                                    Edit
                                </a>
                            </div>

                            <form action="{{ route('guru.materi.destroy', $item->id) }}" method="POST"
                                class="mt-2"
                                onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-xl transition">
                                    Hapus Materi
                                </button>
                            </form>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
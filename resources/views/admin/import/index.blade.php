<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-gradient-to-r from-blue-700 to-slate-900 rounded-3xl p-8 text-white shadow-lg mb-8">
                <p class="text-blue-100 font-semibold mb-2">Manajemen Data</p>
                <h1 class="text-3xl md:text-4xl font-extrabold">Import Data</h1>
                <p class="text-blue-100 mt-3 max-w-2xl">
                    Import data siswa dan guru menggunakan file Excel agar input akun lebih cepat.
                </p>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-bold mb-4">
                        SW
                    </div>

                    <h2 class="text-xl font-bold text-slate-800">Import Siswa</h2>
                    <p class="text-sm text-slate-500 mt-1 mb-5">
                        Upload file Excel berisi data siswa.
                    </p>

                    <form action="{{ route('admin.import.siswa') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="file" name="file" required
                            class="block w-full text-sm text-slate-700 border border-slate-300 rounded-xl cursor-pointer bg-white p-3 mb-5">

                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition">
                            Import Data Siswa
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold mb-4">
                        GR
                    </div>

                    <h2 class="text-xl font-bold text-slate-800">Import Guru</h2>
                    <p class="text-sm text-slate-500 mt-1 mb-5">
                        Upload file Excel berisi data guru.
                    </p>

                    <form action="{{ route('admin.import.guru') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="file" name="file" required
                            class="block w-full text-sm text-slate-700 border border-slate-300 rounded-xl cursor-pointer bg-white p-3 mb-5">

                        <button type="submit"
                            class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-xl transition">
                            Import Data Guru
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
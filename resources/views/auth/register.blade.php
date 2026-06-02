<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-sky-50 via-white to-emerald-50 flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-5xl bg-white rounded-[32px] shadow-[0_20px_60px_rgba(0,0,0,0.08)] overflow-hidden border border-slate-100 grid grid-cols-1 lg:grid-cols-2">

            {{-- Kiri --}}
            <div class="hidden lg:flex flex-col justify-between bg-gradient-to-br from-sky-100 via-blue-50 to-emerald-100 p-10">
                <div>
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-16 h-16 rounded-2xl bg-white shadow-md flex items-center justify-center text-3xl">
                            🎓
                        </div>

                        <div>
                            <h1 class="text-3xl font-extrabold text-slate-800 leading-tight">
                                LMS SMA
                            </h1>
                            <p class="text-slate-600 text-sm">
                                Learning Management System
                            </p>
                        </div>
                    </div>

                    <p class="text-sm font-semibold text-sky-700 uppercase tracking-wider mb-3">
                        Daftar Akun
                    </p>

                    <h2 class="text-4xl font-extrabold text-slate-800 leading-tight mb-4">
                        Mulai Akses Pembelajaran Digital Sekolah
                    </h2>

                    <p class="text-slate-600 text-lg leading-relaxed">
                        Buat akun untuk mengakses materi, tugas, kuis, nilai, absensi, dan jadwal pembelajaran di LMS SMA.
                    </p>
                </div>

                <div class="space-y-4 mt-10">
                    <div class="bg-white/80 backdrop-blur rounded-2xl p-4 shadow-sm border border-white">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center text-2xl">
                                📚
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-lg">Materi Sesuai Kelas</h3>
                                <p class="text-slate-600 text-sm">
                                    Akses materi pembelajaran berdasarkan kelas yang terdaftar.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur rounded-2xl p-4 shadow-sm border border-white">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-2xl">
                                ✅
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-lg">Tugas dan Kuis</h3>
                                <p class="text-slate-600 text-sm">
                                    Kerjakan tugas dan kuis dalam satu platform yang rapi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kanan --}}
            <div class="p-8 lg:p-12 flex items-center">
                <div class="w-full max-w-md mx-auto">

                    <div class="text-center mb-8">
                        <div class="w-20 h-20 mx-auto rounded-3xl bg-sky-100 flex items-center justify-center text-4xl shadow-sm mb-4">
                            🏫
                        </div>

                        <h2 class="text-3xl font-extrabold text-slate-800 mb-2">
                            Buat Akun Baru
                        </h2>

                        <p class="text-slate-500">
                            Daftar untuk mulai menggunakan LMS SMA.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                                Nama Lengkap
                            </label>

                            <input id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Masukkan nama lengkap"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 placeholder-slate-400 focus:border-sky-400 focus:ring focus:ring-sky-100 outline-none transition">

                            @error('name')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                                Email
                            </label>

                            <input id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                placeholder="contoh@email.com"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 placeholder-slate-400 focus:border-sky-400 focus:ring focus:ring-sky-100 outline-none transition">

                            @error('email')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                                Password
                            </label>

                            <input id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Masukkan password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 placeholder-slate-400 focus:border-sky-400 focus:ring focus:ring-sky-100 outline-none transition">

                            @error('password')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">
                                Konfirmasi Password
                            </label>

                            <input id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Ulangi password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 placeholder-slate-400 focus:border-sky-400 focus:ring focus:ring-sky-100 outline-none transition">

                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full rounded-2xl bg-sky-600 hover:bg-sky-700 text-white font-bold py-3.5 shadow-md hover:shadow-lg transition duration-200">
                            Daftar
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-slate-500">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="font-bold text-sky-600 hover:text-sky-700">
                                Masuk di sini
                            </a>
                        </p>
                    </div>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-slate-400">
                            LMS SMA • Platform Pembelajaran Digital Sekolah
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </div>
</x-guest-layout>
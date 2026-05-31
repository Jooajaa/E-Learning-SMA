<x-guest-layout>
    <div class="min-h-screen bg-slate-100 flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">

            {{-- KIRI --}}
            <div class="relative bg-gradient-to-br from-blue-700 via-blue-800 to-slate-900 text-white p-10 lg:p-14 overflow-hidden">
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="w-16 h-16 rounded-2xl bg-white/15 backdrop-blur flex items-center justify-center shadow-lg border border-white/20">
                            <span class="text-4xl">🎓</span>
                        </div>

                        <div>
                            <h1 class="text-3xl font-extrabold tracking-tight">
                                LMS SMA
                            </h1>
                            <p class="text-blue-100 text-sm">
                                Learning Management System
                            </p>
                        </div>
                    </div>

                    <h2 class="text-4xl lg:text-5xl font-extrabold leading-tight mb-5">
                        Sistem Pembelajaran<br>
                        Digital Sekolah
                    </h2>

                    <p class="text-blue-100 text-lg leading-relaxed mb-10 max-w-md">
                        Kelola materi, tugas, kuis, absensi, nilai, dan jadwal pembelajaran dalam satu platform LMS SMA.
                    </p>

                    <div class="grid grid-cols-1 gap-4 max-w-md">
                        <div class="flex items-center gap-4 bg-white/10 border border-white/15 rounded-2xl p-4 backdrop-blur">
                            <div class="w-11 h-11 rounded-xl bg-green-400 flex items-center justify-center text-slate-900 font-bold">
                                ✓
                            </div>
                            <div>
                                <p class="font-bold">Pembelajaran Online</p>
                                <p class="text-sm text-blue-100">Materi dan tugas dapat diakses siswa.</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-white/10 border border-white/15 rounded-2xl p-4 backdrop-blur">
                            <div class="w-11 h-11 rounded-xl bg-yellow-400 flex items-center justify-center text-slate-900 font-bold">
                                ★
                            </div>
                            <div>
                                <p class="font-bold">Evaluasi Siswa</p>
                                <p class="text-sm text-blue-100">Kuis, nilai, dan pengumpulan tugas.</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-white/10 border border-white/15 rounded-2xl p-4 backdrop-blur">
                            <div class="w-11 h-11 rounded-xl bg-sky-300 flex items-center justify-center text-slate-900 font-bold">
                                ☑
                            </div>
                            <div>
                                <p class="font-bold">Absensi & Jadwal</p>
                                <p class="text-sm text-blue-100">Pantau kehadiran dan jadwal belajar.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute -right-24 -bottom-24 w-72 h-72 bg-white/10 rounded-full"></div>
                <div class="absolute -left-20 -top-20 w-56 h-56 bg-blue-300/20 rounded-full"></div>
                <div class="absolute right-16 top-20 w-20 h-20 bg-yellow-300/20 rounded-full"></div>
            </div>

            {{-- KANAN --}}
            <div class="p-8 sm:p-12 lg:p-14 flex items-center bg-white">
                <div class="w-full max-w-md mx-auto">

                    <div class="mb-8 text-center">
                        <div class="mx-auto w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center shadow-lg mb-5">
                            <span class="text-3xl text-white">📚</span>
                        </div>

                        <h2 class="text-3xl font-extrabold text-slate-800">
                            Masuk ke LMS
                        </h2>

                        <p class="text-slate-500 mt-2">
                            Gunakan akun admin, guru, atau siswa
                        </p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-5">
                            <label for="email" class="block text-sm font-bold text-slate-700 mb-2">
                                Email
                            </label>

                            <input id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="contoh@email.com"
                                class="w-full rounded-xl border-slate-300 px-4 py-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-5">
                            <label for="password" class="block text-sm font-bold text-slate-700 mb-2">
                                Password
                            </label>

                            <input id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="w-full rounded-xl border-slate-300 px-4 py-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between mb-6">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                    class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">

                                <span class="ml-2 text-sm text-slate-600">
                                    Ingat saya
                                </span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm font-bold text-blue-600 hover:text-blue-800">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-3 rounded-xl shadow-lg transition">
                            LOGIN
                        </button>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-slate-500">
                            LMS SMA - Platform Pembelajaran Digital
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
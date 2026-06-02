<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-sky-50 via-white to-emerald-50 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 bg-white rounded-[32px] shadow-[0_20px_60px_rgba(0,0,0,0.08)] overflow-hidden border border-slate-100">

            <!-- Kiri -->
            <div class="relative bg-gradient-to-br from-sky-100 via-blue-50 to-emerald-100 p-8 lg:p-12">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-16 h-16 rounded-2xl bg-white shadow-md flex items-center justify-center text-3xl">
                        🎓
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-800 leading-tight">LMS SMA</h1>
                        <p class="text-slate-600 text-sm">Platform pembelajaran sekolah yang lebih mudah, rapi, dan nyaman digunakan.</p>
                    </div>
                </div>

                <div class="mb-10">
                    <p class="text-sm font-semibold text-sky-700 uppercase tracking-wider mb-3">
                        Selamat Datang
                    </p>
                    <h2 class="text-4xl lg:text-5xl font-extrabold text-slate-800 leading-tight mb-4">
                        Sistem Pembelajaran Digital untuk Sekolah
                    </h2>
                    <p class="text-slate-600 text-lg leading-relaxed">
                        Kelola materi, tugas, kuis, absensi, nilai, dan jadwal belajar dalam satu platform yang sederhana dan mudah dipahami.
                    </p>
                </div>

                <div class="space-y-4">
                    <div class="bg-white/80 backdrop-blur rounded-2xl p-4 shadow-sm border border-white">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center text-2xl">
                                📚
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-lg">Materi Pembelajaran</h3>
                                <p class="text-slate-600 text-sm">Siswa dapat melihat materi belajar sesuai kelas yang diikuti.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur rounded-2xl p-4 shadow-sm border border-white">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-2xl">
                                📝
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-lg">Tugas dan Kuis</h3>
                                <p class="text-slate-600 text-sm">Guru dapat membagikan tugas dan kuis, siswa bisa langsung mengerjakan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur rounded-2xl p-4 shadow-sm border border-white">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-2xl">
                                📅
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-lg">Absensi dan Jadwal</h3>
                                <p class="text-slate-600 text-sm">Pantau kehadiran, jadwal pelajaran, dan aktivitas akademik secara teratur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kanan -->
            <div class="p-8 lg:p-12 flex items-center">
                <div class="w-full max-w-md mx-auto">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 mx-auto rounded-3xl bg-sky-100 flex items-center justify-center text-4xl shadow-sm mb-4">
                            🏫
                        </div>
                        <h2 class="text-3xl font-extrabold text-slate-800 mb-2">Masuk ke Akun</h2>
                        <p class="text-slate-500">
                            Silakan login menggunakan akun admin, guru, atau siswa.
                        </p>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 text-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                                Email
                            </label>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   autocomplete="username"
                                   placeholder="Masukkan email"
                                   class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 placeholder-slate-400 focus:border-sky-400 focus:ring focus:ring-sky-100 outline-none transition">
                            @error('email')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                                Password
                            </label>
                            <input id="password"
                                   type="password"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   placeholder="Masukkan password"
                                   class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 placeholder-slate-400 focus:border-sky-400 focus:ring focus:ring-sky-100 outline-none transition">
                            @error('password')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="flex items-center justify-between gap-4 text-sm">
                            <label class="flex items-center gap-2 text-slate-600">
                                <input type="checkbox" name="remember" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                                <span>Ingat saya</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="font-semibold text-sky-600 hover:text-sky-700 transition">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <!-- Button -->
                        <button type="submit"
                                class="w-full rounded-2xl bg-sky-600 hover:bg-sky-700 text-white font-bold py-3.5 shadow-md hover:shadow-lg transition duration-200">
                            Login
                        </button>
                    </form>

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
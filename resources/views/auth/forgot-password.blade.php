<x-guest-layout>
    <div class="min-h-screen bg-slate-100 flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">

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
                        Lupa Password?
                    </h2>

                    <p class="text-blue-100 text-lg leading-relaxed mb-10 max-w-md">
                        Masukkan email akun LMS SMA kamu. Sistem akan mengirimkan link untuk mengatur ulang password.
                    </p>

                    <div class="space-y-4 max-w-md">
                        <div class="flex items-center gap-4 bg-white/10 border border-white/15 rounded-2xl p-4 backdrop-blur">
                            <div class="w-11 h-11 rounded-xl bg-green-400 flex items-center justify-center text-slate-900 font-bold">
                                1
                            </div>
                            <div>
                                <p class="font-bold">Masukkan Email</p>
                                <p class="text-sm text-blue-100">Gunakan email yang terdaftar di LMS.</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-white/10 border border-white/15 rounded-2xl p-4 backdrop-blur">
                            <div class="w-11 h-11 rounded-xl bg-yellow-400 flex items-center justify-center text-slate-900 font-bold">
                                2
                            </div>
                            <div>
                                <p class="font-bold">Cek Link Reset</p>
                                <p class="text-sm text-blue-100">Ikuti instruksi reset password dari email.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute -right-24 -bottom-24 w-72 h-72 bg-white/10 rounded-full"></div>
                <div class="absolute -left-20 -top-20 w-56 h-56 bg-blue-300/20 rounded-full"></div>
            </div>

            {{-- KANAN --}}
            <div class="p-8 sm:p-12 lg:p-14 flex items-center bg-white">
                <div class="w-full max-w-md mx-auto">

                    <div class="mb-8 text-center">
                        <div class="mx-auto w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center shadow-lg mb-5">
                            <span class="text-3xl text-white">🔐</span>
                        </div>

                        <h2 class="text-3xl font-extrabold text-slate-800">
                            Reset Password
                        </h2>

                        <p class="text-slate-500 mt-2">
                            Masukkan email untuk menerima link reset password
                        </p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="email" class="block text-sm font-bold text-slate-700 mb-2">
                                Email
                            </label>

                            <input id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                placeholder="contoh@email.com"
                                class="w-full rounded-xl border-slate-300 px-4 py-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-3 rounded-xl shadow-lg transition">
                            KIRIM LINK RESET PASSWORD
                        </button>

                        <div class="mt-6 text-center">
                            <a href="{{ route('login') }}"
                                class="text-sm font-bold text-blue-600 hover:text-blue-800">
                                Kembali ke Login
                            </a>
                        </div>
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
<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-900 via-blue-700 to-indigo-900 flex items-center justify-center px-4">

        <div class="w-full max-w-5xl bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

            <div class="hidden md:flex flex-col justify-center p-10 text-white">
                <div class="text-6xl mb-6">🎓</div>
                <h1 class="text-4xl font-bold mb-4">LMS SMA</h1>
                <p class="text-blue-100 text-lg">
                    Platform pembelajaran digital untuk admin, guru, dan siswa.
                </p>

                <div class="mt-8 space-y-3 text-sm text-blue-100">
                    <p>✅ Dashboard sesuai role</p>
                    <p>✅ Materi dan tugas online</p>
                    <p>✅ Sistem pembelajaran modern</p>
                </div>
            </div>

            <div class="bg-white p-8 md:p-10 rounded-3xl md:rounded-l-none">
                <div class="text-center mb-8">
                    <div class="mx-auto mb-4 w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center text-white text-3xl shadow-lg">
                        📚
                    </div>

                    <h2 class="text-3xl font-bold text-gray-800">
                        Selamat Datang
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Silakan login ke akun LMS SMA
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Email
                        </label>
                        <input type="email" name="email" required autofocus
                            placeholder="Masukkan email"
                            class="w-full rounded-xl border-gray-300 px-4 py-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Password
                        </label>
                        <input type="password" name="password" required
                            placeholder="Masukkan password"
                            class="w-full rounded-xl border-gray-300 px-4 py-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="mt-5 flex items-center justify-between">
                        <label class="flex items-center text-sm text-gray-600">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2">Remember me</span>
                        </label>

                        <a href="{{ route('password.request') }}"
                            class="text-sm font-medium text-blue-600 hover:text-blue-800">
                            Lupa password?
                        </a>
                    </div>

                    <button type="submit"
                        class="mt-7 w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold shadow-lg transition duration-300">
                        LOGIN
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>
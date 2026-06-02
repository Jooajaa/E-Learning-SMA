<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS SMA</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800 antialiased">
    <div class="min-h-screen">

        {{-- Navbar --}}
        <header class="bg-white/90 backdrop-blur border-b border-slate-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="h-20 flex items-center justify-between">

                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-sky-100 flex items-center justify-center text-2xl shadow-sm">
                            🎓
                        </div>

                        <div>
                            <h1 class="text-xl font-extrabold text-slate-800 leading-tight">
                                LMS SMA
                            </h1>
                            <p class="text-xs text-slate-500">
                                Learning Management System
                            </p>
                        </div>
                    </div>

                    <nav class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-semibold transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-5 py-2.5 rounded-xl text-slate-700 hover:bg-slate-100 font-semibold transition">
                                Login
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-semibold transition">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>

                </div>
            </div>
        </header>

        {{-- Hero --}}
        <main>
            <section class="relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-sky-50 via-white to-emerald-50"></div>

                <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-16 lg:py-24">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                        <div>
                            <div class="inline-flex items-center gap-2 bg-white border border-sky-100 shadow-sm rounded-full px-4 py-2 mb-6">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span class="text-sm font-semibold text-slate-600">
                                    Platform pembelajaran digital sekolah
                                </span>
                            </div>

                            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight">
                                Belajar Lebih Mudah dalam Satu Sistem LMS SMA
                            </h2>

                            <p class="text-lg text-slate-600 leading-relaxed mt-6 max-w-xl">
                                LMS SMA membantu admin, guru, dan siswa mengelola kegiatan pembelajaran seperti materi, tugas, kuis, nilai, absensi, dan jadwal pelajaran secara rapi dan terarah.
                            </p>

                            <div class="flex flex-wrap gap-4 mt-8">
                                <a href="{{ route('login') }}"
                                    class="px-7 py-3.5 rounded-2xl bg-sky-600 hover:bg-sky-700 text-white font-bold shadow-md hover:shadow-lg transition">
                                    Masuk ke LMS
                                </a>

                                <a href="#fitur"
                                    class="px-7 py-3.5 rounded-2xl bg-white hover:bg-slate-50 text-slate-700 font-bold border border-slate-200 shadow-sm transition">
                                    Lihat Fitur
                                </a>
                            </div>
                        </div>

                        <div class="bg-white rounded-[32px] border border-slate-100 shadow-[0_24px_70px_rgba(15,23,42,0.10)] p-6 lg:p-8">
                            <div class="bg-gradient-to-br from-sky-100 to-emerald-100 rounded-[28px] p-6 mb-6">
                                <div class="flex items-center justify-between mb-8">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-500">Dashboard Sekolah</p>
                                        <h3 class="text-2xl font-extrabold text-slate-800 mt-1">
                                            Aktivitas Pembelajaran
                                        </h3>
                                    </div>

                                    <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center text-2xl shadow-sm">
                                        🏫
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-white rounded-2xl p-5 shadow-sm">
                                        <p class="text-sm text-slate-500">Materi</p>
                                        <p class="text-2xl font-extrabold text-sky-700 mt-1">Online</p>
                                    </div>

                                    <div class="bg-white rounded-2xl p-5 shadow-sm">
                                        <p class="text-sm text-slate-500">Tugas</p>
                                        <p class="text-2xl font-extrabold text-emerald-700 mt-1">Terarah</p>
                                    </div>

                                    <div class="bg-white rounded-2xl p-5 shadow-sm">
                                        <p class="text-sm text-slate-500">Kuis</p>
                                        <p class="text-2xl font-extrabold text-amber-600 mt-1">Cepat</p>
                                    </div>

                                    <div class="bg-white rounded-2xl p-5 shadow-sm">
                                        <p class="text-sm text-slate-500">Absensi</p>
                                        <p class="text-2xl font-extrabold text-purple-700 mt-1">Rapi</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center gap-4 bg-slate-50 border border-slate-100 rounded-2xl p-4">
                                    <div class="w-11 h-11 rounded-xl bg-sky-100 flex items-center justify-center">
                                        📚
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800">Materi sesuai kelas</h4>
                                        <p class="text-sm text-slate-500">Siswa hanya melihat materi dari kelasnya.</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 bg-slate-50 border border-slate-100 rounded-2xl p-4">
                                    <div class="w-11 h-11 rounded-xl bg-emerald-100 flex items-center justify-center">
                                        ✅
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800">Tugas dan nilai</h4>
                                        <p class="text-sm text-slate-500">Guru dapat memberi tugas dan menilai pengumpulan siswa.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            {{-- Fitur --}}
            <section id="fitur" class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="text-center max-w-2xl mx-auto mb-12">
                        <p class="text-sky-700 font-bold mb-2">Fitur LMS</p>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">
                            Dibuat untuk kebutuhan sekolah
                        </h2>
                        <p class="text-slate-500 mt-3">
                            Setiap role memiliki akses berbeda agar proses belajar lebih jelas dan tidak tercampur.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-slate-50 rounded-3xl border border-slate-100 p-7">
                            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl mb-5">
                                👨‍💼
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-800">Admin Sekolah</h3>
                            <p class="text-slate-500 mt-3 leading-relaxed">
                                Mengelola data kelas, guru, siswa, mata pelajaran, jadwal, dan penugasan akademik.
                            </p>
                        </div>

                        <div class="bg-slate-50 rounded-3xl border border-slate-100 p-7">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-2xl mb-5">
                                👨‍🏫
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-800">Guru</h3>
                            <p class="text-slate-500 mt-3 leading-relaxed">
                                Mengunggah materi, membuat tugas, membuat kuis, memeriksa pengumpulan, dan melihat absensi.
                            </p>
                        </div>

                        <div class="bg-slate-50 rounded-3xl border border-slate-100 p-7">
                            <div class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center text-2xl mb-5">
                                👨‍🎓
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-800">Siswa</h3>
                            <p class="text-slate-500 mt-3 leading-relaxed">
                                Mengakses materi, mengumpulkan tugas, mengerjakan kuis, melihat nilai, absensi, dan jadwal.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Footer --}}
            <footer class="bg-slate-900 text-white py-8">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="font-extrabold text-lg">LMS SMA</h3>
                        <p class="text-slate-400 text-sm mt-1">
                            Platform Pembelajaran Digital Sekolah
                        </p>
                    </div>

                    <p class="text-slate-400 text-sm">
                        © {{ date('Y') }} LMS SMA. Semua hak dilindungi.
                    </p>
                </div>
            </footer>
        </main>

    </div>
</body>
</html>
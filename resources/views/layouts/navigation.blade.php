<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex">
                {{-- Logo --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold">
                            🎓
                        </div>

                        <div class="hidden sm:block">
                            <div class="font-extrabold text-gray-800 leading-tight">
                                LMS SMA
                            </div>
                            <div class="text-xs text-gray-500 -mt-1">
                                Learning Management System
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Desktop Navigation --}}
                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @role('admin')
                        <x-nav-link :href="route('admin.kelas.index')" :active="request()->routeIs('admin.kelas.*')">
                            Kelas
                        </x-nav-link>

                        <x-nav-link :href="route('admin.mapel.index')" :active="request()->routeIs('admin.mapel.*')">
                            Mapel
                        </x-nav-link>

                        <x-nav-link :href="route('admin.siswa.index')" :active="request()->routeIs('admin.siswa.*')">
                            Siswa
                        </x-nav-link>

                        <x-nav-link :href="route('admin.guru.index')" :active="request()->routeIs('admin.guru.*')">
                            Guru
                        </x-nav-link>

                        <x-nav-link :href="route('admin.penugasan.index')" :active="request()->routeIs('admin.penugasan.*')">
                            Penugasan
                        </x-nav-link>

                        <x-nav-link :href="route('admin.jadwal.index')" :active="request()->routeIs('admin.jadwal.*')">
                            Jadwal
                        </x-nav-link>

                        <x-nav-link :href="route('admin.import.index')" :active="request()->routeIs('admin.import.*')">
                            Import
                        </x-nav-link>

                        <x-nav-link :href="route('kalender.index')" :active="request()->routeIs('kalender.*')">
                            Kalender
                        </x-nav-link>
                    @endrole

                    @role('guru')
                        <x-nav-link :href="route('guru.materi.index')" :active="request()->routeIs('guru.materi.*')">
                            Materi
                        </x-nav-link>

                        <x-nav-link :href="route('guru.tugas.index')" :active="request()->routeIs('guru.tugas.*')">
                            Tugas
                        </x-nav-link>

                        <x-nav-link :href="route('guru.kuis.index')" :active="request()->routeIs('guru.kuis.*')">
                            Kuis
                        </x-nav-link>

                        <x-nav-link :href="route('guru.pengumpulan.index')" :active="request()->routeIs('guru.pengumpulan.*')">
                            Pengumpulan
                        </x-nav-link>

                        <x-nav-link :href="route('guru.nilai.index')" :active="request()->routeIs('guru.nilai.*')">
                            Nilai
                        </x-nav-link>

                        <x-nav-link :href="route('guru.absensi.index')" :active="request()->routeIs('guru.absensi.*')">
                            Absensi
                        </x-nav-link>

                        <x-nav-link :href="route('guru.jadwal.index')" :active="request()->routeIs('guru.jadwal.*')">
                            Jadwal
                        </x-nav-link>

                        <x-nav-link :href="route('kalender.index')" :active="request()->routeIs('kalender.*')">
                            Kalender
                        </x-nav-link>
                    @endrole

                    @role('siswa')
                        <x-nav-link :href="route('siswa.materi.index')" :active="request()->routeIs('siswa.materi.*')">
                            Materi
                        </x-nav-link>

                        <x-nav-link :href="route('siswa.tugas.index')" :active="request()->routeIs('siswa.tugas.*')">
                            Tugas
                        </x-nav-link>

                        <x-nav-link :href="route('siswa.kuis.index')" :active="request()->routeIs('siswa.kuis.*')">
                            Kuis
                        </x-nav-link>

                        <x-nav-link :href="route('siswa.nilai.index')" :active="request()->routeIs('siswa.nilai.*')">
                            Nilai
                        </x-nav-link>

                        <x-nav-link :href="route('siswa.absensi.index')" :active="request()->routeIs('siswa.absensi.*')">
                            Absensi
                        </x-nav-link>

                        <x-nav-link :href="route('siswa.jadwal.index')" :active="request()->routeIs('siswa.jadwal.*')">
                            Jadwal
                        </x-nav-link>

                        <x-nav-link :href="route('kalender.index')" :active="request()->routeIs('kalender.*')">
                            Kalender
                        </x-nav-link>
                    @endrole

                </div>
            </div>

            {{-- Settings Dropdown --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-semibold rounded-md text-gray-600 bg-white hover:text-gray-800 focus:outline-none transition ease-in-out duration-150">
                            <div>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-2 text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-700">
                                @role('admin')
                                    Admin
                                @elserole('guru')
                                    Guru
                                @elserole('siswa')
                                    Siswa
                                @else
                                    User
                                @endrole
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Responsive Navigation --}}
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @role('admin')
                <x-responsive-nav-link :href="route('admin.kelas.index')" :active="request()->routeIs('admin.kelas.*')">
                    Kelas
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.mapel.index')" :active="request()->routeIs('admin.mapel.*')">
                    Mapel
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.siswa.index')" :active="request()->routeIs('admin.siswa.*')">
                    Siswa
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.guru.index')" :active="request()->routeIs('admin.guru.*')">
                    Guru
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.penugasan.index')" :active="request()->routeIs('admin.penugasan.*')">
                    Penugasan
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.jadwal.index')" :active="request()->routeIs('admin.jadwal.*')">
                    Jadwal
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.import.index')" :active="request()->routeIs('admin.import.*')">
                    Import
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('kalender.index')" :active="request()->routeIs('kalender.*')">
                    Kalender
                </x-responsive-nav-link>
            @endrole

            @role('guru')
                <x-responsive-nav-link :href="route('guru.materi.index')" :active="request()->routeIs('guru.materi.*')">
                    Materi
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('guru.tugas.index')" :active="request()->routeIs('guru.tugas.*')">
                    Tugas
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('guru.kuis.index')" :active="request()->routeIs('guru.kuis.*')">
                    Kuis
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('guru.pengumpulan.index')" :active="request()->routeIs('guru.pengumpulan.*')">
                    Pengumpulan
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('guru.nilai.index')" :active="request()->routeIs('guru.nilai.*')">
                    Nilai
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('guru.absensi.index')" :active="request()->routeIs('guru.absensi.*')">
                    Absensi
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('guru.jadwal.index')" :active="request()->routeIs('guru.jadwal.*')">
                    Jadwal
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('kalender.index')" :active="request()->routeIs('kalender.*')">
                    Kalender
                </x-responsive-nav-link>
            @endrole

            @role('siswa')
                <x-responsive-nav-link :href="route('siswa.materi.index')" :active="request()->routeIs('siswa.materi.*')">
                    Materi
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('siswa.tugas.index')" :active="request()->routeIs('siswa.tugas.*')">
                    Tugas
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('siswa.kuis.index')" :active="request()->routeIs('siswa.kuis.*')">
                    Kuis
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('siswa.nilai.index')" :active="request()->routeIs('siswa.nilai.*')">
                    Nilai
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('siswa.absensi.index')" :active="request()->routeIs('siswa.absensi.*')">
                    Absensi
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('siswa.jadwal.index')" :active="request()->routeIs('siswa.jadwal.*')">
                    Jadwal
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('kalender.index')" :active="request()->routeIs('kalender.*')">
                    Kalender
                </x-responsive-nav-link>
            @endrole
        </div>

        {{-- Responsive Settings --}}
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                    {{ Auth::user()->name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
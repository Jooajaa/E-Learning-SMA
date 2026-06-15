<nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- KIRI: Logo dan Menu --}}
            <div class="flex">
                {{-- Logo --}}
                <div class="shrink-0 flex items-center">
                    @auth
                        @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                        @elseif (Auth::user()->hasRole('guru'))
                            <a href="{{ route('guru.dashboard') }}" class="flex items-center gap-3">
                        @elseif (Auth::user()->hasRole('siswa'))
                            <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-3">
                        @else
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        @endif
                    @else
                        <a href="/" class="flex items-center gap-3">
                    @endauth

                        <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white text-xl shadow-sm">
                            🎓
                        </div>

                        <div class="leading-tight hidden sm:block">
                            <h1 class="font-extrabold text-slate-900 text-lg">LMS SMA</h1>
                            <p class="text-xs text-slate-500">Learning Management System</p>
                        </div>
                    </a>
                </div>

                {{-- Menu Desktop --}}
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    @auth
                        {{-- ADMIN --}}
                        @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('admin.dashboard') }}"
                               class="{{ request()->routeIs('admin.dashboard') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Dashboard
                            </a>

                            <a href="{{ route('admin.kelas.index') }}"
                               class="{{ request()->routeIs('admin.kelas.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Kelas
                            </a>

                            <a href="{{ route('admin.mapel.index') }}"
                               class="{{ request()->routeIs('admin.mapel.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Mapel
                            </a>

                            <a href="{{ route('admin.siswa.index') }}"
                               class="{{ request()->routeIs('admin.siswa.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Siswa
                            </a>

                            <a href="{{ route('admin.guru.index') }}"
                               class="{{ request()->routeIs('admin.guru.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Guru
                            </a>

                            <a href="{{ route('admin.penugasan.index') }}"
                               class="{{ request()->routeIs('admin.penugasan.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Penugasan
                            </a>

                            <a href="{{ route('admin.jadwal.index') }}"
                               class="{{ request()->routeIs('admin.jadwal.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Jadwal
                            </a>

                            <a href="{{ route('admin.import.index') }}"
                               class="{{ request()->routeIs('admin.import.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Import
                            </a>

                            <a href="{{ route('kalender.index') }}"
                               class="{{ request()->routeIs('kalender.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Kalender
                            </a>
                        @endif

                        {{-- GURU --}}
                        @if (Auth::user()->hasRole('guru'))
                            <a href="{{ route('guru.dashboard') }}"
                               class="{{ request()->routeIs('guru.dashboard') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Dashboard
                            </a>

                            <a href="{{ route('guru.jadwal.index') }}"
                               class="{{ request()->routeIs('guru.jadwal.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Jadwal
                            </a>

                            <a href="{{ route('kalender.index') }}"
                               class="{{ request()->routeIs('kalender.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Kalender
                            </a>
                        @endif

                        {{-- SISWA --}}
                        @if (Auth::user()->hasRole('siswa'))
                            <a href="{{ route('siswa.dashboard') }}"
                               class="{{ request()->routeIs('siswa.dashboard') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Dashboard
                            </a>

                            <a href="{{ route('siswa.jadwal.index') }}"
                               class="{{ request()->routeIs('siswa.jadwal.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Jadwal
                            </a>

                            <a href="{{ route('kalender.index') }}"
                               class="{{ request()->routeIs('kalender.*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Kalender
                            </a>
                        @endif
                    @endauth

                </div>
            </div>

            {{-- KANAN: User Dropdown --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-slate-600 bg-white hover:text-slate-800 focus:outline-none transition ease-in-out duration-150">
                                    <div class="text-right">
                                        <div class="font-semibold text-slate-800">
                                            {{ Auth::user()->name }}
                                        </div>

                                        <div class="text-xs text-slate-500">
                                            @if (Auth::user()->hasRole('admin'))
                                                Admin
                                            @elseif (Auth::user()->hasRole('guru'))
                                                Guru
                                            @elseif (Auth::user()->hasRole('siswa'))
                                                Siswa
                                            @else
                                                User
                                            @endif
                                        </div>
                                    </div>

                                    <div class="ml-2">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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
                                        Keluar
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth
            </div>

            {{-- Tombol Mobile --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                    class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden sm:hidden border-t border-slate-200 bg-white">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                {{-- ADMIN MOBILE --}}
                @if (Auth::user()->hasRole('admin'))
                    <a href="{{ route('admin.dashboard') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Dashboard</a>
                    <a href="{{ route('admin.kelas.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Kelas</a>
                    <a href="{{ route('admin.mapel.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Mapel</a>
                    <a href="{{ route('admin.siswa.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Siswa</a>
                    <a href="{{ route('admin.guru.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Guru</a>
                    <a href="{{ route('admin.penugasan.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Penugasan</a>
                    <a href="{{ route('admin.jadwal.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Jadwal</a>
                    <a href="{{ route('admin.import.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Import</a>
                    <a href="{{ route('kalender.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Kalender</a>
                @endif

                {{-- GURU MOBILE --}}
                @if (Auth::user()->hasRole('guru'))
                    <a href="{{ route('guru.dashboard') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Dashboard</a>
                    <a href="{{ route('guru.jadwal.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Jadwal</a>
                    <a href="{{ route('kalender.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Kalender</a>
                @endif

                {{-- SISWA MOBILE --}}
                @if (Auth::user()->hasRole('siswa'))
                    <a href="{{ route('siswa.dashboard') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Dashboard</a>
                    <a href="{{ route('siswa.jadwal.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Jadwal</a>
                    <a href="{{ route('kalender.index') }}" class="block pl-4 pr-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">Kalender</a>
                @endif
            @endauth
        </div>

        @auth
            <div class="pt-4 pb-3 border-t border-slate-200">
                <div class="px-4">
                    <div class="font-medium text-base text-slate-800">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="font-medium text-sm text-slate-500">
                        {{ Auth::user()->email }}
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">
                        Profil
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="w-full text-left block px-4 py-2 text-base font-medium text-slate-600 hover:bg-slate-50">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
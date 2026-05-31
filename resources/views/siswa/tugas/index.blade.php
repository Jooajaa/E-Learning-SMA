@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">
        Daftar Tugas
    </h1>

    <div class="grid md:grid-cols-2 gap-6">

        @forelse($tugas as $item)

            <div class="bg-white shadow rounded-xl p-6">

                <h2 class="text-xl font-bold mb-3">
                    {{ $item->judul }}
                </h2>

                <div class="mb-3 text-gray-600">
                    Deadline:
                    {{ $item->deadline }}
                </div>

                <!-- Countdown -->

                <div class="mb-4">

                    @php
                        $deadline = \Carbon\Carbon::parse($item->deadline);
                    @endphp

                    @if(now()->lessThan($deadline))

                        <div class="text-green-600 font-semibold">

                            Sisa waktu:
                            {{ now()->diffForHumans($deadline, true) }}

                        </div>

                    @else

                        <div class="text-red-600 font-semibold">

                            Deadline telah lewat

                        </div>

                    @endif

                </div>

                <a href="{{ route('siswa.tugas.show', $item->id) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                    Detail Tugas

                </a>

            </div>

        @empty

            <div class="bg-white shadow rounded-xl p-6">

                Belum ada tugas

            </div>

        @endforelse

    </div>

</div>

@endsection
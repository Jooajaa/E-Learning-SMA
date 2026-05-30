@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white shadow rounded-xl p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-3xl font-bold">
                Detail Tugas
            </h1>

            <a href="{{ route('guru.tugas.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded-lg">

                Kembali

            </a>

        </div>

        <!-- Judul -->

        <div class="mb-6">

            <h2 class="text-xl font-semibold mb-2">
                Judul Tugas
            </h2>

            <div class="border rounded-lg p-4 bg-gray-50">

                {{ $tugas->judul }}

            </div>

        </div>

        <!-- Deadline -->

        <div class="mb-6">

            <h2 class="text-xl font-semibold mb-2">
                Deadline
            </h2>

            <div class="border rounded-lg p-4 bg-gray-50">

                {{ $tugas->deadline }}

            </div>

        </div>

        <!-- Instruksi -->

        <div class="mb-6">

            <h2 class="text-xl font-semibold mb-2">
                Instruksi
            </h2>

            <div class="border rounded-lg p-4 bg-gray-50 whitespace-pre-line">

                {{ $tugas->instruksi }}

            </div>

        </div>

        <!-- File -->

        <div class="mb-6">

            <h2 class="text-xl font-semibold mb-2">
                File Tugas
            </h2>

            <div class="border rounded-lg p-4 bg-gray-50">

                @if($tugas->file)

                    <a href="{{ asset('storage/' . $tugas->file) }}"
                       target="_blank"
                       class="text-blue-600 underline">

                        Download File

                    </a>

                @else

                    Tidak ada file

                @endif

            </div>

        </div>

    </div>

</div>

@endsection
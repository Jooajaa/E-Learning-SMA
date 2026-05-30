@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white shadow rounded-xl p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-3xl font-bold">
                {{ $tugas->judul }}
            </h1>

            <a href="{{ route('siswa.tugas.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded-lg">

                Kembali

            </a>

        </div>

        <!-- Deadline -->

        <div class="mb-6">

            <h2 class="font-semibold mb-2">
                Deadline
            </h2>

            <div class="border rounded-lg p-4 bg-gray-50">

                {{ $tugas->deadline }}

            </div>

        </div>

        <!-- Countdown -->

        <div class="mb-6">

            @php
                $deadline = \Carbon\Carbon::parse($tugas->deadline);
            @endphp

            @if(now()->lessThan($deadline))

                <div class="text-green-600 font-bold">

                    Sisa waktu:
                    {{ now()->diffForHumans($deadline, true) }}

                </div>

            @else

                <div class="text-red-600 font-bold">

                    Deadline telah lewat

                </div>

            @endif

        </div>

        <!-- Instruksi -->

        <div class="mb-6">

            <h2 class="font-semibold mb-2">
                Instruksi
            </h2>

            <div class="border rounded-lg p-4 bg-gray-50 whitespace-pre-line">

                {{ $tugas->instruksi }}

            </div>

        </div>

        <!-- File Tugas -->

        <div class="mb-6">

            <h2 class="font-semibold mb-2">
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

        <!-- Pengumpulan Tugas -->

        <div class="mt-8">

            <h2 class="text-xl font-bold mb-4">
                Pengumpulan Tugas
            </h2>

            @if($pengumpulan)

                <div class="bg-green-100 text-green-700 p-4 rounded-lg">

                    <p class="font-bold">
                        ✓ Tugas sudah dikumpulkan
                    </p>

                    <p class="mt-2">
                        Status:
                        {{ $pengumpulan->status }}
                    </p>

                    <p class="mt-2">
                        File:
                        <a href="{{ asset('storage/' . $pengumpulan->file) }}"
                            target="_blank"
                            class="text-blue-600 underline">
                                Lihat Jawaban
                        </a>
                    </p>

                    @if($pengumpulan->komentar)

                        <div class="mt-4 border-t pt-3">

                            <strong>Komentar Guru:</strong>

                        <p>
                            {{ $pengumpulan->komentar }}
                        </p>

                        </div>

                    @endif

                </div>

            @else

                @if(session('success'))

                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">

                        {{ session('success') }}

                    </div>

            @endif

            @if ($errors->any())

                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">

                    <ul class="list-disc ml-5">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('siswa.pengumpulan.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                @csrf

                <input type="hidden"
                    name="tugas_id"
                    value="{{ $tugas->id }}">

                <div class="mb-4">

                    <label class="block font-semibold mb-2">
                        Upload File Jawaban
                    </label>

                    <input type="file"
                            name="file"
                            class="w-full border rounded-lg p-3">

                    <small class="text-gray-500">
                        Format: PDF, DOC, DOCX, ZIP
                    </small>

                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">

                    Upload Jawaban

                </button>

            </form>

            @endif

        </div>

@endsection
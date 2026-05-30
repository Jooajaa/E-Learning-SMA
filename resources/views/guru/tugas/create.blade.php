@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white shadow rounded-xl p-6">

        <h1 class="text-2xl font-bold mb-6">
            Tambah Tugas
        </h1>

        @if ($errors->any())

            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">

                <ul class="list-disc ml-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('guru.tugas.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- Judul -->

            <div class="mb-5">

                <label class="block font-semibold mb-2">
                    Judul Tugas
                </label>

                <input type="text"
                       name="judul"
                       class="w-full border rounded-lg p-3"
                       placeholder="Masukkan judul tugas"
                       value="{{ old('judul') }}">

            </div>

            <!-- Instruksi -->

            <div class="mb-5">

                <label class="block font-semibold mb-2">
                    Instruksi Tugas
                </label>

                <textarea name="instruksi"
                          rows="6"
                          class="w-full border rounded-lg p-3"
                          placeholder="Masukkan instruksi tugas">{{ old('instruksi') }}</textarea>

            </div>

            <!-- Deadline -->

            <div class="mb-5">

                <label class="block font-semibold mb-2">
                    Deadline
                </label>

                <input type="datetime-local"
                       name="deadline"
                       class="w-full border rounded-lg p-3"
                       value="{{ old('deadline') }}">

            </div>

            <!-- Upload File -->

            <div class="mb-5">

                <label class="block font-semibold mb-2">
                    File Tugas
                </label>

                <input type="file"
                       name="file"
                       class="w-full border rounded-lg p-3">

                <small class="text-gray-500">
                    PDF, DOC, DOCX, PPT, ZIP
                </small>

            </div>

            <!-- Button -->

            <div class="flex gap-3">

                <button type="submit"
                        class="bg-blue-600 text-white px-5 py-3 rounded-lg">

                    Simpan Tugas

                </button>

                <a href="{{ route('guru.tugas.index') }}"
                   class="bg-gray-500 text-white px-5 py-3 rounded-lg">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection
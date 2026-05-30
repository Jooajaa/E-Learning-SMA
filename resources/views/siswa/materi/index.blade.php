<h1>Daftar Materi Siswa</h1>

@foreach($materi as $item)

    <hr>

    <h3>{{ $item->judul }}</h3>

    <p>{{ $item->deskripsi }}</p>

    <a href="{{ route('siswa.materi.show', $item->id) }}">
        Detail
    </a>

@endforeach
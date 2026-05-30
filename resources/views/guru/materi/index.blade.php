<h1>Daftar Materi</h1>

@if(session('success'))
    <p>
        {{ session('success') }}
    </p>
@endif

<a href="{{ route('guru.materi.create') }}">
    Tambah Materi
</a>

@foreach($materi as $item)

    <hr>

    <h3>{{ $item->judul }}</h3>

    <p>{{ $item->deskripsi }}</p>

    <a href="{{ asset('storage/' . $item->file) }}">
        Download
    </a>

    <br><br>

    <a href="{{ route('guru.materi.show', $item->id) }}">
        Detail
    </a>

    <br>

    <a href="{{ route('guru.materi.edit', $item->id) }}">
        Edit
    </a>

    <br><br>

    <form action="{{ route('guru.materi.destroy', $item->id) }}"
          method="POST">

        @csrf
        @method('DELETE')

        <button type="submit">
            Hapus
        </button>

    </form>

@endforeach
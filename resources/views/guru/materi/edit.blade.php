<h1>Edit Materi</h1>

<form action="{{ route('guru.materi.update', $materi->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div>
        <label>Judul Materi</label>

        <input type="text"
               name="judul"
               value="{{ $materi->judul }}">
    </div>

    <br>

    <div>
        <label>Deskripsi</label>

        <textarea name="deskripsi">{{ $materi->deskripsi }}</textarea>
    </div>

    <br>

    <div>
        <label>Ganti File</label>

        <input type="file" name="file">
    </div>

    <br>

    <button type="submit">
        Update Materi
    </button>

</form>

<br>

<a href="{{ route('guru.materi.index') }}">
    Kembali
</a>
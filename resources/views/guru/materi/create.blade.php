<h1>Tambah Materi</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('guru.materi.store') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <div>
        <label>Judul Materi</label>
        <input type="text" name="judul">
    </div>

    <br>

    <div>
        <label>Deskripsi</label>
        <textarea name="deskripsi"></textarea>
    </div>

    <br>

    <div>
        <label>File Materi</label>
        <input type="file" name="file">
    </div>

    <br>

    <button type="submit">
        Upload Materi
    </button>

</form>
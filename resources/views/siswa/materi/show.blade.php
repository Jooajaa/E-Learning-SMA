<h1>Detail Materi</h1>

<h3>{{ $materi->judul }}</h3>

<p>{{ $materi->deskripsi }}</p>

<a href="{{ asset('storage/' . $materi->file) }}">
    Download Materi
</a>

<br><br>

<a href="{{ route('siswa.materi.index') }}">
    Kembali
</a>
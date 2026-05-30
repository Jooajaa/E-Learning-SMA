@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">
        Riwayat Pengumpulan Tugas
    </h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Tugas</th>
                        <th>Deadline</th>
                        <th>File Jawaban</th>
                        <th>Status</th>
                        <th>Komentar Guru</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($pengumpulan as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $item->tugas->judul }}
                        </td>

                        <td>
                            {{ $item->tugas->deadline }}
                        </td>

                        <td>
                            <a
                                href="{{ asset('storage/'.$item->file) }}"
                                target="_blank"
                                class="btn btn-primary btn-sm"
                            >
                                Lihat File
                            </a>
                        </td>

                        <td>
                            <span class="badge bg-success">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>

                        <td>
                            {{ $item->komentar ?? '-' }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada tugas yang dikumpulkan
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
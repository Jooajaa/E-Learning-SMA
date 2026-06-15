<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi'; // ganti ke 'absensis' kalau nama tabelnya absensis

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'mata_pelajaran_id',
        'tanggal',
        'status',
        'keterangan',
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $table = 'kuis';

    protected $fillable = [
        'judul',
        'deskripsi',
        'waktu_mulai',
        'waktu_selesai',
        'guru_id',
        'kelas_id',
    ];

    public function soal()
    {
        return $this->hasMany(SoalKuis::class, 'kuis_id');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
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
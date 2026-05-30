<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    use HasFactory;

    protected $table = 'pengumpulan_tugas';

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'file',
        'status',
        'komentar',
    ];

    // Relasi ke tugas
    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    // Relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
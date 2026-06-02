<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruKelas extends Model
{
    protected $fillable = [
        'guru_id',
        'kelas_id',
        'mata_pelajaran_id',
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}
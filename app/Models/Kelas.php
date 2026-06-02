<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'jurusan',
    ];

    public function siswa()
    {
        return $this->hasMany(SiswaKelas::class);
    }

    public function guruKelas()
    {
        return $this->hasMany(GuruKelas::class);
    }
}
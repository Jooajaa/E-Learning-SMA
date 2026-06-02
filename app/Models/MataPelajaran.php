<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $fillable = [
        'nama_mapel',
        'kode_mapel',
        'sks',
    ];

    public function guruMapel()
    {
        return $this->hasMany(GuruMapel::class);
    }

    public function guruKelas()
    {
        return $this->hasMany(GuruKelas::class);
    }
}
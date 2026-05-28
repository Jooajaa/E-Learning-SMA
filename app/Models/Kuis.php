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
    ];

    public function soal()
    {
        return $this->hasMany(SoalKuis::class, 'kuis_id');
    }
}
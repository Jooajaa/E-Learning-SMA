<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanKuis extends Model
{
    protected $table = 'jawaban_kuis';

    protected $fillable = [
        'kuis_id',
        'soal_kuis_id',
        'siswa_id',
        'jawaban',
        'benar',
    ];
}
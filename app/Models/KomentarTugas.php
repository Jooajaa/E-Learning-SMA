<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KomentarTugas extends Model
{
    use HasFactory;

    protected $table = 'komentar_tugas';

    protected $fillable = [
        'pengumpulan_tugas_id',
        'komentar'
    ];

    public function pengumpulan()
    {
        return $this->belongsTo(PengumpulanTugas::class);
    }
}
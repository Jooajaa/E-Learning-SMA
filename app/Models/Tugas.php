<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';

    protected $fillable = [
        'guru_id',
        'judul',
        'instruksi',
        'deadline',
        'file',
    ];

    // Relasi ke guru
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // Relasi pengumpulan tugas
    public function pengumpulan()
    {
        return $this->hasMany(PengumpulanTugas::class);
    }
}
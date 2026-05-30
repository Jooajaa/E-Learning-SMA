<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = [
        'guru_id',
        'judul',
        'deskripsi',
        'file',
        'thumbnail',
        'is_active',
    ];

    // Relasi ke user guru
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}

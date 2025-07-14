<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Evaluasi extends Model
{
    protected $fillable = [
        'user_id',
        'periode',
        'total_jam_kerja',
        'jumlah_tugas_selesai',
        'nilai_kehadiran',
        'nilai_tugas',
        'nilai_akhir',
        'penilaian',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


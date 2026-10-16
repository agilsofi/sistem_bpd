<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembinaan extends Model
{
    protected $table = 'pembinaan';
    protected $primaryKey = 'id_pembinaan';
    
    protected $fillable = [
        'id_siswa',
        'id_pembina',
        'tanggal',
        'alasan',
        'jenis_pembinaan',
        'hasil',
        'tindak_lanjut',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function pembina()
    {
        return $this->belongsTo(Guru::class, 'id_pembina');
    }
}

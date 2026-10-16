<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoinPelanggaran extends Model
{
    protected $table = 'poin_pelanggaran';
    protected $primaryKey = 'id_poin';
    public $timestamps = false;
    
    protected $fillable = [
        'id_siswa',
        'id_laporan',
        'tanggal',
        'keterangan',
        'poin',
        'id_pemberi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function laporan()
    {
        return $this->belongsTo(LaporanPerilaku::class, 'id_laporan');
    }

    public function pemberi()
    {
        return $this->belongsTo(Guru::class, 'id_pemberi');
    }
}

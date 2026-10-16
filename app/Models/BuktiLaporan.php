<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiLaporan extends Model
{
    protected $table = 'bukti_laporan';
    protected $primaryKey = 'id_bukti';
    public $timestamps = false;
    
    protected $fillable = [
        'id_laporan',
        'nama_file',
        'lokasi_file',
        'tipe_file',
        'ukuran_file',
        'tanggal_upload',
        'status',
    ];

    protected $casts = [
        'tanggal_upload' => 'datetime',
    ];

    public function laporanPerilaku()
    {
        return $this->belongsTo(LaporanPerilaku::class, 'id_laporan');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPerilaku extends Model
{
    protected $table = 'laporan_perilaku';
    protected $primaryKey = 'id_laporan';
    
    protected $fillable = [
        'id_siswa',
        'id_guru',
        'id_jenis_perilaku',
        'tanggal_kejadian',
        'keterangan',
        'status_verifikasi',
        'id_bk_verifikator',
        'tanggal_verifikasi',
        'catatan_verifikasi',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'date',
        'tanggal_verifikasi' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function jenisPerilaku()
    {
        return $this->belongsTo(JenisPerilaku::class, 'id_jenis_perilaku');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function bkVerifikator()
    {
        return $this->belongsTo(Guru::class, 'id_bk_verifikator');
    }

    public function buktiLaporan()
    {
        return $this->hasMany(BuktiLaporan::class, 'id_laporan');
    }

    public function poinPelanggaran()
    {
        return $this->hasOne(PoinPelanggaran::class, 'id_laporan');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratPanggilan extends Model
{
    protected $table = 'surat_panggilan';
    protected $primaryKey = 'id_panggilan';
    
    protected $fillable = [
        'id_siswa',
        'id_sp',
        'id_jenis_panggilan',
        'nomor_surat',
        'tanggal_surat',
        'tanggal_panggilan',
        'perihal',
        'isi_surat',
        'status_panggilan',
        'tanggal_hadir',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_panggilan' => 'date',
        'tanggal_hadir' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function sp()
    {
        return $this->belongsTo(SP::class, 'id_sp');
    }

    public function jenisPanggilan()
    {
        return $this->belongsTo(JenisPanggilan::class, 'id_jenis_panggilan');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPerilaku extends Model
{
    protected $table = 'jenis_perilaku';
    protected $primaryKey = 'id_jenis_perilaku';
    
    protected $fillable = [
        'id_kategori',
        'nama_perilaku',
        'poin_pelanggaran',
        'keterangan',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPerilaku::class, 'id_kategori');
    }

    public function laporanPerilaku()
    {
        return $this->hasMany(LaporanPerilaku::class, 'id_jenis_perilaku');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SP extends Model
{
    protected $table = 'sp';
    protected $primaryKey = 'id_sp';
    
    protected $fillable = [
        'id_siswa',
        'id_ketentuan_sp',
        'nomor_sp',
        'tanggal_sp',
        'total_poin',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'tanggal_sp' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function ketentuanSP()
    {
        return $this->belongsTo(KetentuanSP::class, 'id_ketentuan_sp');
    }

    public function suratPanggilan()
    {
        return $this->hasMany(SuratPanggilan::class, 'id_sp');
    }
}

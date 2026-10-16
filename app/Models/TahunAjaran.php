<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id_tahun_ajaran';
    
    protected $fillable = [
        'nama_tahun_ajaran',
        'semester',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function getTahunAjaranAttribute()
    {
        return $this->nama_tahun_ajaran;
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_tahun_ajaran');
    }

    public function laporanPerilaku()
    {
        return $this->hasMany(LaporanPerilaku::class, 'id_tahun_ajaran');
    }

    public function pembinaan()
    {
        return $this->hasMany(Pembinaan::class, 'id_tahun_ajaran');
    }

    public function reward()
    {
        return $this->hasMany(Reward::class, 'id_tahun_ajaran');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    
    protected $fillable = [
        'NIS',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'id_kelas',
        'status',
        'id_user',
        'nama_ayah', 
        'pekerjaan_ayah', 
        'nama_ibu', 
        'pekerjaan_ibu', 
        'no_hp_orang_tua', 
        'alamat'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id_siswa', 'id_siswa');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function laporanPerilaku()
    {
        return $this->hasMany(LaporanPerilaku::class, 'id_siswa');
    }

    public function poinPelanggaran()
    {
        return $this->hasMany(PoinPelanggaran::class, 'id_siswa');
    }

    public function pembinaan()
    {
        return $this->hasMany(Pembinaan::class, 'id_siswa');
    }

    public function reward()
    {
        return $this->hasMany(Reward::class, 'id_siswa');
    }

    public function kreditReward()
    {
        return $this->hasMany(KreditReward::class, 'id_siswa');
    }

    public function sp()
    {
        return $this->hasMany(SP::class, 'id_siswa');
    }

    public function suratPanggilan()
    {
        return $this->hasMany(SuratPanggilan::class, 'id_siswa');
    }

    // Calculate total poin pelanggaran dinamis
    public function getTotalPoinAttribute()
    {
        return $this->poinPelanggaran()
        ->whereHas('laporan', function ($query) {
            $query->where('status_verifikasi', 'disetujui');
        })
        ->sum('poin');
    }

    // Calculate total kredit reward dinamis
    public function getTotalKreditAttribute()
    {
        return $this->kreditReward()->sum('kredit_poin');
    }
}

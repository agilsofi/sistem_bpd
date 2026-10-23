<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    
    protected $fillable = [
        'nuptk',
        'nama_guru',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telepon',
        'email',
        'alamat',
        'foto',
        'status',
        'status_wali_kelas',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id_guru', 'id_guru');
    }

    public function kelasAsWali()
    {
        return $this->hasMany(Kelas::class, 'id_wali_kelas');
    }

    public function getIsWaliKelasAttribute()
    {
        return $this->status_wali_kelas === 'ya' || $this->kelasAsWali()->exists();
    }

    public function laporanPerilaku()
    {
        return $this->hasMany(LaporanPerilaku::class, 'id_guru');
    }

    public function verifikasiLaporan()
    {
        return $this->hasMany(LaporanPerilaku::class, 'id_bk_verifikator');
    }

    public function pembinaan()
    {
        return $this->hasMany(Pembinaan::class, 'id_pembina');
    }

    public function kreditReward()
    {
        return $this->hasMany(KreditReward::class, 'id_pemberi');
    }

    public function poinPelanggaran()
    {
        return $this->hasMany(PoinPelanggaran::class, 'id_pemberi');
    }
}

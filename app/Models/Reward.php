<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $table = 'reward';
    protected $primaryKey = 'id_reward';
    
    protected $fillable = [
        'id_siswa',
        'id_jenis_reward',
        'id_pemberi',
        'id_tahun_ajaran',
        'tanggal_reward',
        'deskripsi',
        'bukti_foto',
        'status',
    ];

    protected $casts = [
        'tanggal_reward' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function jenisReward()
    {
        return $this->belongsTo(JenisReward::class, 'id_jenis_reward');
    }

    public function pemberi()
    {
        return $this->belongsTo(Guru::class, 'id_pemberi');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
    }

    public function kreditReward()
    {
        return $this->hasOne(KreditReward::class, 'id_reward');
    }
}

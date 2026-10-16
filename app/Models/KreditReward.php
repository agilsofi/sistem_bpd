<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KreditReward extends Model
{
    protected $table = 'kredit_reward';
    protected $primaryKey = 'id_kredit_reward';
    
    public $timestamps = false;

    protected $fillable = [
        'id_siswa',
        'id_jenis_reward',
        'tanggal',
        'alasan',
        'kredit_poin',
        'id_pemberi',
    ];

    protected $casts = [
        'tanggal' => 'date',
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisReward extends Model
{
    protected $table = 'jenis_reward';
    protected $primaryKey = 'id_jenis_reward';
    
    protected $fillable = [
        'nama_reward',
        'kredit_poin',
        'keterangan',
        'status',
    ];

    public function reward()
    {
        return $this->hasMany(Reward::class, 'id_jenis_reward');
    }
}

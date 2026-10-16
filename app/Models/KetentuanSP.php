<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KetentuanSP extends Model
{
    protected $table = 'ketentuan_sp';
    protected $primaryKey = 'id_ketentuan_sp';
    
    protected $fillable = [
        'tingkat_sp',
        'batas_poin_min',
        'batas_poin_max',
        'sanksi',
        'keterangan',
    ];

    public function sp()
    {
        return $this->hasMany(SP::class, 'id_ketentuan_sp');
    }
}

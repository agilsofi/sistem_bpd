<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KetentuanPenghargaan extends Model
{
    protected $table = 'ketentuan_penghargaan';
    protected $primaryKey = 'id_ketentuan';
    
    protected $fillable = [
        'batas_kredit',
        'nama_penghargaan',
        'keterangan',
    ];
}

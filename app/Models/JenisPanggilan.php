<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPanggilan extends Model
{
    protected $table = 'jenis_panggilan';
    protected $primaryKey = 'id_jenis_panggilan';
    
    protected $fillable = [
        'nama_jenis',
        'keterangan',
    ];

    public function suratPanggilan()
    {
        return $this->hasMany(SuratPanggilan::class, 'id_jenis_panggilan');
    }
}

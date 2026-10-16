<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPerilaku extends Model
{
    protected $table = 'kategori_perilaku';
    protected $primaryKey = 'id_kategori';
    
    protected $fillable = [
        'nama_kategori',
        'keterangan',
        'status',
    ];

    public function jenisPerilaku()
    {
        return $this->hasMany(JenisPerilaku::class, 'id_kategori');
    }
}

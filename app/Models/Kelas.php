<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    
    protected $fillable = [
        'id_jurusan',
        'id_tahun_ajaran',
        'tingkat',
        'nama_kelas',
        'id_wali_kelas',
        'kapasitas',
        'status',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
    }

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'id_wali_kelas');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }
}

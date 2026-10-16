<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriPerilaku;
use App\Models\JenisPerilaku;
use App\Models\JenisReward;
use App\Models\KetentuanPenghargaan;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Kategori Perilaku
        KategoriPerilaku::create([
            'nama_kategori' => 'Kedisiplinan',
            'keterangan' => 'Pelanggaran terkait keterlambatan dan ketidakhadiran',
            'status' => 'aktif',
        ]);

        KategoriPerilaku::create([
            'nama_kategori' => 'Keteladanan',
            'keterangan' => 'Pelanggaran terkait perilaku tidak sopan dan tidak bertanggung jawab',
            'status' => 'aktif',
        ]);

        KategoriPerilaku::create([
            'nama_kategori' => 'Kekerasan',
            'keterangan' => 'Pelanggaran terkait kekerasan fisik dan verbal',
            'status' => 'aktif',
        ]);

        KategoriPerilaku::create([
            'nama_kategori' => 'Kerapian dan Kebersihan',
            'keterangan' => 'Pelanggaran terkait kerapian diri dan kebersihan lingkungan',
            'status' => 'aktif',
        ]);

        // Jenis Perilaku
        // Kedisiplinan
        JenisPerilaku::create([
            'id_kategori' => 1,
            'nama_perilaku' => 'Terlambat Masuk Sekolah',
            'poin_pelanggaran' => 1,
            'keterangan' => 'Siswa datang setelah jam masuk',
            'status' => 'aktif',
        ]);

        JenisPerilaku::create([
            'id_kategori' => 1,
            'nama_perilaku' => 'Tidak Membawa ID Card',
            'poin_pelanggaran' => 1,
            'keterangan' => 'Siswa tidak membawa ID card saat masuk',
            'status' => 'aktif',
        ]);

        // Keteladanan
        JenisPerilaku::create([
            'id_kategori' => 2,
            'nama_perilaku' => 'Membuat Kebisingan',
            'poin_pelanggaran' => 2,
            'keterangan' => 'Siswa membuat suara keras di area kelas',
            'status' => 'aktif',
        ]);

        JenisPerilaku::create([
            'id_kategori' => 2,
            'nama_perilaku' => 'Tidak Menghormati Guru',
            'poin_pelanggaran' => 3,
            'keterangan' => 'Siswa berbicara kasar atau tidak sopan kepada guru',
            'status' => 'aktif',
        ]);

        // Kekerasan
        JenisPerilaku::create([
            'id_kategori' => 3,
            'nama_perilaku' => 'Kekerasan Fisik Ringan',
            'poin_pelanggaran' => 10,
            'keterangan' => 'Mendorong atau menarik tanpa menyebabkan luka',
            'status' => 'aktif',
        ]);

        JenisPerilaku::create([
            'id_kategori' => 3,
            'nama_perilaku' => 'Kekerasan Fisik Berat',
            'poin_pelanggaran' => 25,
            'keterangan' => 'Membuat luka fisik pada siswa lain',
            'status' => 'aktif',
        ]);

        // Kerapian dan Kebersihan
        JenisPerilaku::create([
            'id_kategori' => 4,
            'nama_perilaku' => 'Seragam Tidak Rapi',
            'poin_pelanggaran' => 1,
            'keterangan' => 'Seragam tidak sesuai standar kerapian',
            'status' => 'aktif',
        ]);

        // Jenis Reward
        JenisReward::create([
            'nama_reward' => 'Penghargaan Akademik',
            'kredit_poin' => 5,
            'keterangan' => 'Nilai rapor bagus atau prestasi akademik',
            'status' => 'aktif',
        ]);

        JenisReward::create([
            'nama_reward' => 'Perilaku Baik',
            'kredit_poin' => 3,
            'keterangan' => 'Sikap disiplin dan sopan',
            'status' => 'aktif',
        ]);

        JenisReward::create([
            'nama_reward' => 'Prestasi Olahraga',
            'kredit_poin' => 10,
            'keterangan' => 'Menjuarai lomba olahraga',
            'status' => 'aktif',
        ]);

        // Ketentuan Penghargaan
        KetentuanPenghargaan::create([
            'batas_kredit' => 500,
            'nama_penghargaan' => 'Siswa Berprestasi',
            'keterangan' => 'Diberikan kepada siswa dengan kredit poin >= 500',
        ]);

        KetentuanPenghargaan::create([
            'batas_kredit' => 750,
            'nama_penghargaan' => 'Siswa Teladan',
            'keterangan' => 'Diberikan kepada siswa dengan kredit poin >= 750',
        ]);

        KetentuanPenghargaan::create([
            'batas_kredit' => 1000,
            'nama_penghargaan' => 'Siswa Paling Teladan',
            'keterangan' => 'Diberikan kepada siswa dengan kredit poin >= 1000',
        ]);
    }
}

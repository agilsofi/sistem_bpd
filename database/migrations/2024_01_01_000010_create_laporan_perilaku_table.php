<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_perilaku', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->unsignedBigInteger('id_siswa')->comment('FK ke siswa');
            $table->unsignedBigInteger('id_guru')->comment('FK ke guru (pelapor)');
            $table->unsignedBigInteger('id_jenis_perilaku')->comment('FK ke jenis_perilaku');
            $table->date('tanggal_kejadian')->comment('Tanggal kejadian perilaku');
            $table->text('keterangan')->comment('Deskripsi kejadian');
            $table->enum('status_verifikasi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->unsignedBigInteger('id_bk_verifikator')->nullable()->comment('FK ke guru (BK verifikator)');
            $table->date('tanggal_verifikasi')->nullable();
            $table->text('catatan_verifikasi')->nullable()->comment('Catatan dari BK saat verifikasi');
            $table->timestamps();

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_guru')->references('id_guru')->on('guru')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_jenis_perilaku')->references('id_jenis_perilaku')->on('jenis_perilaku')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_bk_verifikator')->references('id_guru')->on('guru')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_perilaku');
    }
};

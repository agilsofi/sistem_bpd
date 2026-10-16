<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poin_pelanggaran', function (Blueprint $table) {
            $table->id('id_poin');
            $table->unsignedBigInteger('id_siswa')->comment('FK ke siswa');
            $table->unsignedBigInteger('id_laporan')->comment('FK ke laporan_perilaku');
            $table->date('tanggal')->comment('Tanggal poin diberikan');
            $table->text('keterangan')->comment('Keterangan poin');
            $table->integer('poin')->comment('Jumlah poin pelanggaran');
            $table->unsignedBigInteger('id_pemberi')->comment('FK ke guru (pemberi poin)');

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_laporan')->references('id_laporan')->on('laporan_perilaku')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pemberi')->references('id_guru')->on('guru')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poin_pelanggaran');
    }
};

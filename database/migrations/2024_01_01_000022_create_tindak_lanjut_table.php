<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tindak_lanjut', function (Blueprint $table) {
            $table->id('id_tindak_lanjut');
            $table->unsignedBigInteger('id_siswa')->comment('FK ke siswa');
            $table->enum('sumber', ['pembinaan', 'pemanggilan', 'sp'])->comment('Sumber tindak lanjut (polimorfik)');
            $table->unsignedBigInteger('id_sumber')->comment('ID sumber (pembinaan_id/pemanggilan_id/sp_id)');
            $table->date('tanggal')->comment('Tanggal tindak lanjut');
            $table->text('isi')->comment('Isi tindak lanjut');
            $table->unsignedBigInteger('id_pencatat')->comment('FK ke guru (pencatat)');
            $table->enum('status', ['proses', 'selesai'])->default('proses');
            $table->timestamps();

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pencatat')->references('id_guru')->on('guru')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut');
    }
};

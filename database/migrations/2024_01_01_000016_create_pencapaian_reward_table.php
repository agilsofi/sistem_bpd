<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pencapaian_reward', function (Blueprint $table) {
            $table->id('id_pencapaian');
            $table->unsignedBigInteger('id_siswa')->comment('FK ke siswa');
            $table->unsignedBigInteger('id_ketentuan')->comment('FK ke ketentuan_penghargaan');
            $table->date('tanggal_tercapai')->comment('Tanggal mencapai batas kredit');
            $table->integer('total_kredit_saat_tercapai')->comment('Total kredit siswa saat mencapai');
            $table->enum('status_validasi', ['menunggu', 'divalidasi', 'ditolak'])->default('menunggu');
            $table->unsignedBigInteger('id_validator')->nullable()->comment('FK ke guru (validator)');

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_ketentuan')->references('id_ketentuan')->on('ketentuan_penghargaan')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_validator')->references('id_guru')->on('guru')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pencapaian_reward');
    }
};

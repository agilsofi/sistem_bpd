<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kredit_reward', function (Blueprint $table) {
            $table->id('id_kredit_reward');
            $table->unsignedBigInteger('id_siswa')->comment('FK ke siswa');
            $table->unsignedBigInteger('id_jenis_reward')->comment('FK ke jenis_reward');
            $table->date('tanggal')->comment('Tanggal pemberian reward');
            $table->text('alasan')->comment('Alasan pemberian reward');
            $table->integer('kredit_poin')->comment('Jumlah kredit poin');
            $table->unsignedBigInteger('id_pemberi')->comment('FK ke guru (pemberi reward)');

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jenis_reward')->references('id_jenis_reward')->on('jenis_reward')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_pemberi')->references('id_guru')->on('guru')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kredit_reward');
    }
};

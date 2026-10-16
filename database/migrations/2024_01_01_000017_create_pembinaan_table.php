<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembinaan', function (Blueprint $table) {
            $table->id('id_pembinaan');
            $table->unsignedBigInteger('id_siswa')->comment('FK ke siswa');
            $table->date('tanggal')->comment('Tanggal pembinaan');
            $table->unsignedBigInteger('id_pembina')->comment('FK ke guru (pembina)');
            $table->text('alasan')->comment('Alasan pembinaan');
            $table->enum('jenis_pembinaan', ['verbal', 'tertulis', 'mediasi', 'konseling'])->comment('Jenis pembinaan');
            $table->text('hasil')->nullable()->comment('Hasil pembinaan');
            $table->text('tindak_lanjut')->nullable()->comment('Tindak lanjut pembinaan');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pembina')->references('id_guru')->on('guru')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembinaan');
    }
};

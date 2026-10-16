<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_kelas', function (Blueprint $table) {
            $table->id('id_riwayat_kelas');
            $table->unsignedBigInteger('id_siswa')->comment('FK ke siswa');
            $table->unsignedBigInteger('id_kelas')->comment('FK ke kelas');
            $table->unsignedBigInteger('id_tahun_ajaran')->comment('FK ke tahun_ajaran');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_tahun_ajaran')->references('id_tahun_ajaran')->on('tahun_ajaran')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_kelas');
    }
};

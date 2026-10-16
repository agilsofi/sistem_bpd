<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->string('nama_kelas', 10)->comment('Kelas (e.g., X-A, XI-B, XII-C)');
            $table->tinyInteger('tingkat')->comment('10, 11, atau 12');
            $table->unsignedBigInteger('id_jurusan')->comment('FK ke jurusan');
            $table->unsignedBigInteger('id_tahun_ajaran')->comment('FK ke tahun_ajaran');
            $table->unsignedBigInteger('id_wali_kelas')->nullable()->comment('FK ke guru (wali kelas)');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_tahun_ajaran')->references('id_tahun_ajaran')->on('tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_wali_kelas')->references('id_guru')->on('guru')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};

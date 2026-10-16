<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('NIS', 20)->unique()->comment('Nomor Induk Siswa');
            $table->string('nama', 100)->comment('Nama Lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir')->nullable()->comment('Tanggal Lahir');
            $table->enum('status', ['aktif', 'lulus', 'dropout', 'pindah'])->default('aktif');
            $table->unsignedBigInteger('id_kelas')->nullable()->comment('FK ke kelas');
            $table->unsignedBigInteger('id_user')->nullable()->comment('FK ke users');
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};

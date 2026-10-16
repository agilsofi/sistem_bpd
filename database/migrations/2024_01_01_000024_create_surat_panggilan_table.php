<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_panggilan', function (Blueprint $table) {
            $table->id('id_surat');
            $table->string('nomor_surat', 50)->nullable()->comment('Nomor surat (diisi TU)');
            $table->unsignedBigInteger('id_siswa')->comment('FK ke siswa');
            $table->unsignedBigInteger('id_pemanggilan')->nullable()->comment('FK ke pemanggilan (opsional)');
            $table->unsignedBigInteger('id_sp')->nullable()->comment('FK ke sp (opsional)');
            $table->date('tanggal')->comment('Tanggal surat dibuat');
            $table->enum('status_proses_tu', ['diajukan', 'diproses', 'dicetak', 'diserahkan'])->default('diajukan');
            $table->timestamps();

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pemanggilan')->references('id_pemanggilan')->on('pemanggilan')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_sp')->references('id_sp')->on('sp')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_panggilan');
    }
};

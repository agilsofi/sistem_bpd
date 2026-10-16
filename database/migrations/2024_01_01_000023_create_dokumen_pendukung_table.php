<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_pendukung', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->unsignedBigInteger('id_sp')->nullable()->comment('FK ke sp (opsional)');
            $table->unsignedBigInteger('id_pemanggilan')->nullable()->comment('FK ke pemanggilan (opsional)');
            $table->string('nama_file', 255)->comment('Nama file asli');
            $table->string('lokasi_file', 500)->comment('Path file di storage');
            $table->string('tipe_file', 20)->comment('tipe file (jpg, png, pdf)');
            $table->timestamp('tanggal_upload')->useCurrent();

            $table->foreign('id_sp')->references('id_sp')->on('sp')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_pemanggilan')->references('id_pemanggilan')->on('pemanggilan')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_pendukung');
    }
};

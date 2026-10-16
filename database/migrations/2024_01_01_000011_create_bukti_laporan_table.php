<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bukti_laporan', function (Blueprint $table) {
            $table->id('id_bukti');
            $table->unsignedBigInteger('id_laporan')->comment('FK ke laporan_perilaku');
            $table->string('nama_file', 255)->comment('Nama file asli');
            $table->string('lokasi_file', 500)->comment('Path file di storage');
            $table->string('tipe_file', 20)->comment('tipe file (jpg, png, pdf)');
            $table->integer('ukuran_file')->comment('Ukuran file dalam byte');
            $table->timestamp('tanggal_upload')->useCurrent();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->foreign('id_laporan')->references('id_laporan')->on('laporan_perilaku')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukti_laporan');
    }
};

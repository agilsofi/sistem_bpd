<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_perilaku', function (Blueprint $table) {
            $table->id('id_jenis_perilaku');
            $table->unsignedBigInteger('id_kategori')->comment('FK ke kategori_perilaku');
            $table->string('nama_perilaku', 150)->comment('Nama perilaku (e.g., Terlambat Masuk, Membuat Kebisingan)');
            $table->integer('poin_pelanggaran')->default(0)->comment('Poin pelanggaran yang diberikan');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_perilaku')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_perilaku');
    }
};

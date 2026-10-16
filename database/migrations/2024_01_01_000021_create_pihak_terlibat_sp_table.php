<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pihak_terlibat_sp', function (Blueprint $table) {
            $table->id('id_pihak_sp');
            $table->unsignedBigInteger('id_sp')->comment('FK ke sp');
            $table->unsignedBigInteger('id_guru')->nullable()->comment('FK ke guru (opsional, jika guru yang hadir)');
            $table->string('nama_pihak', 100)->comment('Nama pihak yang hadir');
            $table->string('jabatan', 50)->comment('Jabatan/Hubungan (e.g., Orang Tua, Wali)');

            $table->foreign('id_sp')->references('id_sp')->on('sp')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_guru')->references('id_guru')->on('guru')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pihak_terlibat_sp');
    }
};

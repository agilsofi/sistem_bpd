<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sp', function (Blueprint $table) {
            $table->id('id_sp');
            $table->unsignedBigInteger('id_siswa')->comment('FK ke siswa');
            $table->enum('jenis_sp', ['SP1', 'SP2', 'SP3'])->comment('Jenis Surat Peringatan');
            $table->integer('total_poin_saat_sp')->comment('Total poin siswa saat dibuat SP');
            $table->date('tanggal')->comment('Tanggal SP diberikan');
            $table->text('hasil_pertemuan')->nullable()->comment('Hasil pertemuan dengan siswa');
            $table->text('keputusan')->nullable()->comment('Keputusan setelah pertemuan');
            $table->unsignedBigInteger('id_pencatat')->comment('FK ke guru (pencatat SP)');

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pencatat')->references('id_guru')->on('guru')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sp');
    }
};

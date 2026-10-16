<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ketentuan_penghargaan', function (Blueprint $table) {
            $table->id('id_ketentuan');
            $table->integer('batas_kredit')->comment('Batas kredit minimum untuk penghargaan (e.g., 500, 750, 1000)');
            $table->string('nama_penghargaan', 100)->comment('Nama penghargaan (e.g., Siswa Berprestasi, Siswa Teladan)');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ketentuan_penghargaan');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id('id_jurusan');
            $table->string('kode_jurusan', 10)->unique()->comment('Kode Jurusan (e.g., TI, MM, RPL)');
            $table->string('nama_jurusan', 100)->comment('Nama Jurusan');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurusan');
    }
};

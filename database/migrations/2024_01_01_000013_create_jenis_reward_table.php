<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_reward', function (Blueprint $table) {
            $table->id('id_jenis_reward');
            $table->string('nama_reward', 100)->comment('Nama reward (e.g., Penghargaan Akademik, Perilaku Baik)');
            $table->integer('kredit_poin')->comment('Kredit poin yang didapat');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_reward');
    }
};

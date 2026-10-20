<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration.
     */
    public function up(): void
    {
        if (Schema::hasTable('siswa')){
            return;
        }
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');

            $table->string('NIS', 20)
                ->unique()
                ->comment('Nomor Induk Siswa');

            $table->string('nama', 100)
                ->comment('Nama Lengkap');

            $table->enum('jenis_kelamin', ['L', 'P']);

            $table->date('tanggal_lahir')
                ->nullable()
                ->comment('Tanggal Lahir');

            $table->enum('status', [
                'aktif',
                'lulus',
                'dropout',
                'pindah'
            ])->default('aktif');

            // Foreign key ditambahkan setelah tabel kelas tersedia.
            $table->unsignedBigInteger('id_kelas')
                ->nullable()
                ->comment('FK ke kelas');

            $table->unsignedBigInteger('id_user')
                ->nullable()
                ->comment('FK ke users');

            $table->timestamps();
        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};

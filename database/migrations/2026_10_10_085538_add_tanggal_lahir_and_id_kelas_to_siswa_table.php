<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Jika tabel siswa belum ada, hentikan proses
        if (!Schema::hasTable('siswa')) {
            return;
        }

        // Cek dan tambah kolom tanggal_lahir
        if (!Schema::hasColumn('siswa', 'tanggal_lahir')) {
            Schema::table('siswa', function (Blueprint $table) {
                $table->date('tanggal_lahir')
                    ->nullable()
                    ->after('jenis_kelamin');
            });
        }

        // Cek dan tambah kolom id_kelas
        if (!Schema::hasColumn('siswa', 'id_kelas')) {
            Schema::table('siswa', function (Blueprint $table) {
                $table->unsignedBigInteger('id_kelas')
                    ->nullable()
                    ->after('status');
            });
        }

        // Tambahkan foreign key hanya jika tabel kelas tersedia dan FK belum ada
        if (Schema::hasTable('kelas')) {
            $foreignKey = DB::select(
                "SELECT CONSTRAINT_NAME
                 FROM information_schema.KEY_COLUMN_USAGE
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'siswa'
                   AND COLUMN_NAME = 'id_kelas'
                   AND REFERENCED_TABLE_NAME = 'kelas'"
            );

            if (empty($foreignKey)) {
                Schema::table('siswa', function (Blueprint $table) {
                    $table->foreign('id_kelas')
                        ->references('id_kelas')
                        ->on('kelas')
                        ->nullOnDelete()
                        ->cascadeOnUpdate();
                });
            }
        }
    }

    public function down(): void
    {
        // Sengaja tidak menghapus kolom agar data aman saat rollback.
        // Tapi kita hapus foreign key-nya terlebih dahulu jika ada.
        if (Schema::hasColumn('siswa', 'id_kelas')) {
            $foreignKey = DB::select(
                "SELECT CONSTRAINT_NAME
                 FROM information_schema.KEY_COLUMN_USAGE
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'siswa'
                   AND COLUMN_NAME = 'id_kelas'
                   AND REFERENCED_TABLE_NAME = 'kelas'"
            );

            if (!empty($foreignKey)) {
                Schema::table('siswa', function (Blueprint $table) {
                    $table->dropForeign(['id_kelas']);
                });
            }
        }
    }
};
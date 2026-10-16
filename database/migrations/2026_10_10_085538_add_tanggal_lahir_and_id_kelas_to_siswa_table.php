<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            if (!Schema::hasColumn('siswa', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('jenis_kelamin');
            }
            if (!Schema::hasColumn('siswa', 'id_kelas')) {
                $table->unsignedBigInteger('id_kelas')->nullable()->after('status');
                $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('set null')->onUpdate('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign(['id_kelas']);
            $table->dropColumn(['tanggal_lahir', 'id_kelas']);
        });
    }
};

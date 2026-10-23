<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('poin_pelanggaran', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pemberi')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('poin_pelanggaran', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pemberi')->nullable(false)->change();
        });
    }
};

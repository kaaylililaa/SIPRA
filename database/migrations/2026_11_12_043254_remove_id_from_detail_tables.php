<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus PK dan kolom id dari detail_pinjam
        Schema::table('detail_pinjam', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropColumn('id');
        });

        // Hapus PK dan kolom id dari detail_kembali
        Schema::table('detail_kembali', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropColumn('id');
        });
    }

    public function down(): void
    {
        // Kembalikan id pada detail_pinjam
        Schema::table('detail_pinjam', function (Blueprint $table) {
            $table->bigIncrements('id');
        });

        // Kembalikan id pada detail_kembali
        Schema::table('detail_kembali', function (Blueprint $table) {
            $table->bigIncrements('id');
        });
    }
};

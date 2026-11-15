<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Pindahkan data buku_id ke detail_pinjam
        DB::table('detail_pinjam')->insertUsing(
            [
                'peminjaman_id',
                'buku_id',
                'created_at',
                'updated_at'
            ],
            DB::table('peminjaman')
                ->whereNotNull('buku_id')
                ->select(
                    'id',
                    'buku_id',
                    'created_at',
                    'updated_at'
                )
        );

        // 2. Hapus foreign key lama
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropForeign('peminjaman_buku_id_foreign');
        });

        // 3. Hapus kolom buku_id dari peminjaman
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn('buku_id');
        });
    }

    public function down(): void
    {
        // Kembalikan kolom buku_id
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->foreignId('buku_id')
                ->nullable()
                ->after('id')
                ->constrained('buku')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });

        // Ambil buku pertama dari setiap transaksi
        DB::statement("
            UPDATE peminjaman p
            SET p.buku_id = (
                SELECT dp.buku_id
                FROM detail_pinjam dp
                WHERE dp.peminjaman_id = p.id
                ORDER BY dp.id ASC
                LIMIT 1
            )
        ");
    }
};

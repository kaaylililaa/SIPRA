
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // DETAIL_PINJAM
        DB::statement("
            ALTER TABLE detail_pinjam
            MODIFY id BIGINT UNSIGNED NOT NULL
        ");

        DB::statement("
            ALTER TABLE detail_pinjam
            DROP PRIMARY KEY,
            DROP COLUMN id
        ");

        // DETAIL_KEMBALI
        DB::statement("
            ALTER TABLE detail_kembali
            MODIFY id BIGINT UNSIGNED NOT NULL
        ");

        DB::statement("
            ALTER TABLE detail_kembali
            DROP PRIMARY KEY,
            DROP COLUMN id
        ");
    }

    public function down(): void
    {
        // Mengembalikan kolom id detail_pinjam
        DB::statement("
            ALTER TABLE detail_pinjam
            ADD id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST
        ");

        // Mengembalikan kolom id detail_kembali
        DB::statement("
            ALTER TABLE detail_kembali
            ADD id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST
        ");
    }
};

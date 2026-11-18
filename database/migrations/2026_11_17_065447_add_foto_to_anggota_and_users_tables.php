
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('alamat');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            $table->dropColumn('foto');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};

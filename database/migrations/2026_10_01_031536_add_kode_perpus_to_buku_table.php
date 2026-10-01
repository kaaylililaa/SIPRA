<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('buku', function (Blueprint $table) {
        $table->string('kode_perpus')->nullable()->after('isbn');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('buku', function (Blueprint $table) {
        $table->dropColumn('kode_perpus');
    });
}
};

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
    Schema::create('pengembalian', function (Blueprint $table) {
        $table->id();
        $table->string('nama_peminjam');
        $table->date('tanggal_pinjam');
        $table->date('tanggal_kembali');
        $table->enum('status', ['Dikembalikan'])->default('Dikembalikan');
        $table->decimal('denda', 10, 2)->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};

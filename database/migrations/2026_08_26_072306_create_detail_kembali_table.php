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
    Schema::create('detail_kembali', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pengembalian_id')->constrained('pengembalian')->onDelete('cascade');
        $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade');
        $table->decimal('denda', 10, 2)->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kembali');
    }
};

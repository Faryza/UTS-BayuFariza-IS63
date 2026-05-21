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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyewa_id')->constrained('penyewas')->cascadeOnDelete();
            $table->date('tanggal_bayar');
            $table->integer('jumlah');
            $table->string('metode_pembayaran');
            $table->string('status')->default('Belum Lunas'); // Lunas, Belum Lunas
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};

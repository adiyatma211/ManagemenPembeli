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
        Schema::create('laporan_pembelians', function (Blueprint $table) {
            $table->id();
            $table->integer('PembeliID')->nullable();
            $table->integer('GrupPembeliID')->nullable();
            $table->integer('TotalPembelian');
            $table->dateTime('TanggalPembelian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_pembelians');
    }
};

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
        Schema::create('pemasukan', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('kode_pemasukan')->nullable(false);
                $table->unsignedBigInteger('id_pemasukan')->nullable(false);
                $table->unsignedBigInteger('id_donatur')->nullable(false);
                $table->integer('jumlah_pemsukan')->nullable(false);
                $table->dateTime('tanggal_pemasukan')->default('2023-01-01 00:00:00')->nullable(false);
                $table->text('upload')->nullable(true);
    
                $table->foreign('id_pemasukan')->on('jenis_pemasukan')->references('id');
                $table->foreign('id_donatur')->on('donatur')->references('id');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan');
    }
};

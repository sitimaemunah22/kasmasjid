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
        Schema::create('donaturs', function (Blueprint $table) {
            $table->id()->nullable(false);
            $table->string('nama', 255)->nullable(false);
            $table->string('alamat', 255)->nullable(false);
            $table->integer('no_telephone', 12)->nullable(false);
            $table->text('upload')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donaturs');
    }
};

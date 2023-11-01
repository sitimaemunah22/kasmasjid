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
        Schema::create('auths', function (Blueprint $table) {
            $table->intrgr('nik', 16)->nullable(false)->primary();
            $table->integer('password');
            $table->string('username');
            $table->enum('role',['admin','operator']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};

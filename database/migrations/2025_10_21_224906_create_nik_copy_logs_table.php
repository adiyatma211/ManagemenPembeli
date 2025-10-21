﻿<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nik_copy_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('nik');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nik_copy_logs');
    }
};

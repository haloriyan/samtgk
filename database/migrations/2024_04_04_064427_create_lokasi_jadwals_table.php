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
        Schema::create('lokasi_jadwals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lokasi_id')->unsigned()->index();
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
            $table->string('hari');
            $table->string('jam_mulai');
            $table->string('jam_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_jadwals');
    }
};

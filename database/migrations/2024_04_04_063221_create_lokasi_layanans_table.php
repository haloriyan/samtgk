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
        Schema::create('lokasi_layanans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lokasi_id')->unsigned()->index();
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
            $table->bigInteger('layanan_id')->unsigned()->index();
            $table->foreign('layanan_id')->references('id')->on('layanans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_layanans');
    }
};

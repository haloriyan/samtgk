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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->index()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
            $table->string('nomor')->unique();
            $table->date('tanggal')->nullable();
            $table->string('arah'); // masuk, keluar, disposisi
            $table->string('perihal');
            $table->string('pengirim');
            $table->string('kepada');
            $table->string('sifat'); // penting, rahasia
            $table->string('jenis');
            $table->string('filename');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};

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
        Schema::create('data_kamar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar')->unique();
            $table->enum('tipe_kamar', ['Standard', 'Superior', 'Deluxe', 'Executive']);
            $table->decimal('harga_per_malam', 10, 2);
            $table->enum('status_kamar', ['Tersedia', 'Terisi', 'Diperbaiki']);
            $table->string('gambar');
            $table->text('deskripsi_kamar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kamar');
    }
};

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
        Schema::create('data_reservasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer');
            $table->unsignedBigInteger('data_kamar_id');
            $table->dateTime('tanggal_check_in');
            $table->dateTime('tanggal_check_out');
            $table->unsignedTinyInteger('jumlah_tamu');
            $table->enum('tipe_kamar', ['Single', 'Double', 'Suite']);
            $table->enum('status_pembayaran', ['Pending', 'Paid', 'Verified']);
            $table->enum('status_pemesanan', ['Pending', 'Confirmed', 'Check-In', 'Canceled', 'Complete']);
            $table->foreign('data_kamar_id')->references('id')->on('data_kamar')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_reservasi');
    }
};

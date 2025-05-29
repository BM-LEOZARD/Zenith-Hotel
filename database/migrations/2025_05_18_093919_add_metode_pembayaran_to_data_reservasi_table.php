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
        Schema::table('data_reservasi', function (Blueprint $table) {
            $table->string('metode_pembayaran')->after('jumlah_tamu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_reservasi', function (Blueprint $table) {
            $table->dropColumn('metode_pembayaran');
        });
    }
};

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
            $table->decimal('harga', 12, 2)->after('tipe_kamar');
            $table->decimal('total_harga', 12, 2)->after('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_reservasi', function (Blueprint $table) {
            $table->dropColumn(['harga', 'total_harga']);
        });
    }
};

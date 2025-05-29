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
        Schema::create('gambar_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_fasilitas_id')->constrained('data_fasilitas')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_fasilitas');
    }
};

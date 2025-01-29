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
        Schema::create('pembayaran_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pembayaran');
            $table->string('nominal_pembayaran');
            $table->boolean('is_active')->default(true);
            $table->foreignId('id_kegiatan_acara')->constrained('kegiatan_acaras')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_kegiatans');
    }
};
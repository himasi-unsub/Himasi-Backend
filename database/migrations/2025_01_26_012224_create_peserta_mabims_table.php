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
        Schema::create('peserta_mabims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mabim')->constrained('mabims')->onDelete('cascade');
            $table->integer('nilai')->nullable();
            $table->boolean('lulus')->default(false);
            $table->foreignId('id_kategori_mabim')->nullable()->constrained('kategori_mabims')->onDelete('cascade');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_mabims');
    }
};
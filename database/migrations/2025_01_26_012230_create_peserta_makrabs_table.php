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
        Schema::create('peserta_makrabs', function (Blueprint $table) {
            $table->id();
            $table->enum('ukuran_baju', [ 'S', 'M', 'L', 'XL', 'XXL' ])->nullable();
            $table->enum('status_pembayaran', [ 'Lunas', 'Belum Lunas', 'Tidak Bayar', 'Tidak Ikut', 'Selesai' ])->default('Belum Lunas');
            $table->boolean('menerima_jahim')->default(0);
            $table->boolean('menerima_sertifikat')->default(0);
            $table->foreignId('id_makrab')->constrained('makrabs')->onDelete('cascade');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_makrabs');
    }
};
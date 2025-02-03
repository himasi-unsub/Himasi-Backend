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
        Schema::create('detail_pembayaran_makrabs', function (Blueprint $table) {
            $table->id();
            $table->enum('status_pembayaran', ['Baru', 'Valid', 'Tidak Valid']);
            $table->string('bukti_pembayaran');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('id_peserta_makrab')->constrained('peserta_makrabs')->onDelete('cascade');
            $table->foreignId('id_pembayaran_makrab')->constrained('pembayaran_makrabs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembayaran_makrabs');
    }
};

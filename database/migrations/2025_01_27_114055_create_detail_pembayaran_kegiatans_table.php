<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tpetry\PostgresqlEnhanced\Schema\Concerns\ZeroDowntimeMigration;

return new class extends Migration
{
    use ZeroDowntimeMigration;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_pembayaran_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->enum('status_pembayaran', ['Baru', 'Valid', 'Tidak Valid']);
            $table->string('bukti_pembayaran');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('id_peserta_kegiatan')->nullable()->constrained('peserta_kegiatans')->onDelete('set null');
            $table->foreignId('id_pembayaran_kegiatan')->constrained('pembayaran_kegiatans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembayaran_kegiatans');
    }
};
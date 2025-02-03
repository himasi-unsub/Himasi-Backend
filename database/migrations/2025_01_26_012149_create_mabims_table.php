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
        Schema::create('mabims', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->year('tahun_kegiatan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('lokasi');
            $table->enum('status', [ 'Belum Terlaksana', 'Sedang Berlangsung', 'Selesai' ])->default('Belum Terlaksana');
            $table->text('deskripsi')->nullable();
            $table->foreignId('id_dokumen_sertifikat')->nullable()->constrained('dokumen_sertifikats')->onDelete('set null');
            $table->foreignId('id_mahasiswa')->nullable()->constrained('mahasiswas')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mabims');
    }
};
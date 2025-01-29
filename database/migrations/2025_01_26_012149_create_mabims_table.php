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
        Schema::create('mabims', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->year('tahun_kegiatan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('lokasi');
            $table->enum('status', [ 'Belum Terlaksana', 'Sedang Berlangsung', 'Selesai' ])->default('Belum Terlaksana');
            $table->text('deskripsi')->nullable();
            $table->foreignId('id_mahasiswa')->constrained('mahasiswas')->onDelete('set null');
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
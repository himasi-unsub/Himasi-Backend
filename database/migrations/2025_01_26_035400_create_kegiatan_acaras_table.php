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
        Schema::create('kegiatan_acaras', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('tahun_kegiatan');
            $table->string('jenis_kegiatan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('lokasi');
            $table->enum('status', [ 'Belum Terlaksana', 'Sedang Berlangsung', 'Selesai' ])->default('Belum Terlaksana');
            $table->boolean('has_struktur')->default(false);
            $table->boolean('has_peserta')->default(false);
            $table->boolean('has_kehadiran')->default(false);
            $table->boolean('has_registration')->default(false);
            $table->string('deskripsi')->nullable();
            $table->foreignId('id_mahasiswa')->nullable()->constrained('mahasiswas')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_acaras');
    }
};
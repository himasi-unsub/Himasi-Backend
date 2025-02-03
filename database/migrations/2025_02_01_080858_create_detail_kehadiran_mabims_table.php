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
        Schema::create('detail_kehadiran_mabims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kehadiran_mabim')->constrained('kehadiran_mabims')->onDelete('cascade');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswas')->onDelete('cascade');
            $table->enum('status_kehadiran', [ 'Hadir', 'Tidak Hadir', 'Izin', 'Sakit' ]);
            $table->string('keterangan')->nullable();
            $table->string('file_bukti_kehadiran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kehadiran_mabims');
    }
};

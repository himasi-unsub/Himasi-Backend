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
        Schema::create('dokumen_sertifikats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->enum('jenis_dokumen', [ 'sertifikat', 'piagam', 'lainnya' ]);
            $table->enum('jenis_kegiatan', [ 'pkkmb', 'mabim', 'makrab', 'kepanitiaan', 'seminar', 'workshop', 'pelatihan', 'lainnya' ]);
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_sertifikats');
    }
};

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
        Schema::create('dokumen_surat_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokumen_surat_id')->constrained('dokumen_surats')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kegiatan_type'); // 'mabim', 'makrab', 'kegiatan'
            $table->unsignedBigInteger('kegiatan_id'); // ID dari kegiatan yang relevan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_surat_kegiatan');
    }
};

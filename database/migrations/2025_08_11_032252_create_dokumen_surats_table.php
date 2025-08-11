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
        Schema::create('dokumen_surats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_surat');
            $table->string('tujuan');
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->text('isi_surat')->nullable();
            $table->string('file')->nullable();
            $table->enum('status', [
                'draft',
                'pending',
                'disetujui',
                'ditolak',
                'selesai',
            ])->default('draft');
            $table->string('keterangan')->nullable();

            $table->enum('persetujuan', ['ya', 'tidak'])->default('tidak');
            $table->date('tanggal_persetujuan')->nullable();

            $table->foreignId('kategori_surat_id')->nullable()->constrained('kategori_surats')->onUpdate('cascade')->nullOnDelete();
            $table->bigInteger('nomor_urut')->nullable();

            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_surats');
    }
};

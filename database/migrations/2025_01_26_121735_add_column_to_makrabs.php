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
        Schema::table('makrabs', function (Blueprint $table) {
            //
            $table->foreignId('id_dokumen_sertifikat')->nullable()->after('deskripsi')->constrained('dokumen_sertifikats')->onDelete('set null');
            $table->foreignId('id_mahasiswa')->nullable()->after('id_dokumen_sertifikat')->constrained('mahasiswas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('makrabs', function (Blueprint $table) {
            //
        });
    }
};
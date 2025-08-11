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
        Schema::create('jabatan_organisasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->unique();
            $table->string('kode_jabatan', 10)->unique();
            $table->string('keterangan')->nullable();
            $table->boolean('is_panitia')->default(false); // true jika jabatan ini terkait dengan kepanitiaan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_organisasis');
    }
};

<?php

use App\Http\Controllers\GenerateSertifikat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
 ])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

// Generate Sertifikat Mabim
Route::get('/sertifikat/{kegiatan}/peserta/{peserta}', [ GenerateSertifikat::class, 'generateSertifikat' ])
    ->whereAlpha('kegiatan')
    ->whereNumber('peserta')
    ->name('generate-sertifikat');
Route::get('/sertifikat/{kegiatan}/bulk/{records}', [ GenerateSertifikat::class, 'bulkBatchGenerateSertifikat' ])
    ->whereAlpha('kegiatan')
    ->name('bulk-generate-sertifikat');

// Verifikasi Sertifikat
Route::get('/sertifikat/verifikasi/{sha256}', [ GenerateSertifikat::class, 'verifikasiSertifikat' ])->name('verifikasi-sertifikat');

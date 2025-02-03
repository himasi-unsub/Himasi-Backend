<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class KegiatanAcara extends Model
{
    //
    protected $fillable = [
        'nama_kegiatan',
        'tahun_kegiatan',
        'jenis_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'status',
        'has_struktur',
        'has_peserta',
        'has_kehadiran',
        'has_registration',
        'deskripsi',
        'id_dokumen_sertifikat',
        'id_mahasiswa',
     ];

    protected $casts = [
        'tanggal_mulai'    => 'date',
        'tanggal_selesai'  => 'date',
        'has_struktur'     => 'boolean',
        'has_peserta'      => 'boolean',
        'has_kehadiran'    => 'boolean',
        'has_registration' => 'boolean',
     ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function pesertaKegiatan(): HasMany
    {
        return $this->hasMany(PesertaKegiatan::class, 'id_kegiatan_acara');
    }

    public function kehadiranKegiatan(): HasMany
    {
        return $this->hasMany(KehadiranKegiatan::class, 'id_kegiatan_acara');
    }

    public function strukturOrganisasiKegiatan(): HasMany
    {
        return $this->hasMany(StrukturOrganisasiKegiatan::class, 'id_kegiatan_acara');
    }

    public function registrationKegiatan(): HasOneOrMany
    {
        return $this->hasOne(PembayaranKegiatan::class, 'id_kegiatan_acara');
    }

    public function dokumenSertifikat(): BelongsTo
    {
        return $this->belongsTo(DokumenSertifikat::class, 'id_dokumen_sertifikat');
    }

}
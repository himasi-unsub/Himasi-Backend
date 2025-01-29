<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Makrab extends Model
{
    //
    protected $fillable = [
        'nama_kegiatan',
        'tahun_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'status',
        'deskripsi',
        'id_dokumen_sertifikat',
        'id_mahasiswa',
     ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function pesertaMakrab(): HasMany
    {
        return $this->hasMany(PesertaMakrab::class, 'id_makrab');
    }

    public function dokumenSertifikat(): BelongsTo
    {
        return $this->belongsTo(DokumenSertifikat::class, 'id_dokumen_sertifikat');
    }

    public function strukturOrganisasiMakrab(): HasMany
    {
        return $this->hasMany(StrukturOrganisasiMakrab::class, 'id_makrab');
    }
}
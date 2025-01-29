<?php
namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StrukturOrganisasiKegiatan extends Model
{
    //
    protected $fillable = [
        'id_mahasiswa',
        'jabatan',
        'kontak',
        'id_kegiatan_acara',
     ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function kegiatanAcara(): BelongsTo
    {
        return $this->belongsTo(KegiatanAcara::class, 'id_kegiatan_acara');
    }
}
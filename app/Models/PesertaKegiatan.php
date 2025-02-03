<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesertaKegiatan extends Model
{
    protected $fillable = [
        'id_mahasiswa',
        'id_kegiatan_acara'
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class,'id_mahasiswa');
    }

    public function kegiatanAcara(): BelongsTo
    {
        return $this->belongsTo(KegiatanAcara::class, 'id_kegiatan_acara');
    }
}

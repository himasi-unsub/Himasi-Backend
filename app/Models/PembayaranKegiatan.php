<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PembayaranKegiatan extends Model
{
    //
    protected $fillable = [
        'nama_pembayaran',
        'nominal_pembayaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_mulai',
        'jam_selesai',
        'is_active',
        'id_kegiatan_acara',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'is_active'       => 'boolean',
    ];

    public function kegiatanAcara(): BelongsTo
    {
        return $this->belongsTo(KegiatanAcara::class, 'id_kegiatan_acara');
    }

    public function detailPembayaranKegiatan(): HasMany
    {
        return $this->hasMany(DetailPembayaranKegiatan::class, 'id_pembayaran_kegiatan');
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPembayaranKegiatan extends Model
{
    //
    protected $fillable = [
        'status_pembayaran',
        'bukti_pembayaran',
        'id_mahasiswa',
        'id_pembayaran_kegiatan',
     ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }

    public function pembayaranKegiatan(): BelongsTo
    {
        return $this->belongsTo(PembayaranKegiatan::class, 'id_pembayaran_kegiatan', 'id');
    }
}
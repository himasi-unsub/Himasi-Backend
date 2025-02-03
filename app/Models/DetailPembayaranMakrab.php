<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPembayaranMakrab extends Model
{
    protected $fillable = [
        'status_pembayaran',
        'bukti_pembayaran',
        'id_mahasiswa',
        'id_pembayaran_makrab',
     ];

     public function pembayaranMakrab(): BelongsTo
     {
        return $this->belongsTo(PembayaranMakrab::class, 'id_pembayaran_makrab');
     }

     public function mahasiswa(): BelongsTo
     {
        return $this->belongsTo(Mahasiswa::class,'id_mahasiswa');
     }
}

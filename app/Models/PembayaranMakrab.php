<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PembayaranMakrab extends Model
{
    protected $fillable = [
        'nama_pembayaran',
        'nominal_pembayaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_mulai',
        'jam_selesai',
        'is_active',
        'id_makrab',
     ];

   protected $casts = [
      'tanggal_mulai'   => 'date',
      'tanggal_selesai' => 'date',
      'is_active'       => 'boolean',
   ];

     public function makrab(): BelongsTo
     {
        return $this->belongsTo(Makrab::class, 'id_makrab');
     }

     public function detailPembayaranMakrab(): HasMany
     {
        return $this->hasMany(DetailPembayaranMakrab::class, 'id_pembayaran_makrab');
     }

}

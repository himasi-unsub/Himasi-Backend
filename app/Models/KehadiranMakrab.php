<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KehadiranMakrab extends Model
{
    protected $fillable = [
        'nama_kehadiran',
        'keterangan',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_mulai',
        'jam_selesai',
        'kode_kehadiran',
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

     public function detailKehadiranMakrab(): HasMany
     {
        return $this->hasMany(DetailKehadiranMakrab::class, 'id_kehadiran_makrab');
     }
}

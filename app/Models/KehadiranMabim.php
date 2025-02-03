<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KehadiranMabim extends Model
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
        'id_mabim',
     ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'is_active'       => 'boolean',
     ];

     public function mabim(): BelongsTo
     {
        return $this->belongsTo(Mabim::class, 'id_mabim');
     }

     public function detailKehadiranMabim(): HasMany
     {
        return $this->hasMany(DetailKehadiranMabim::class, 'id_kehadiran_mabim');
     }
}

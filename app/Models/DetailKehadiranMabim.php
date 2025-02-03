<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailKehadiranMabim extends Model
{
     //
 protected $_fillable = [
  'id_kehadiran_mabim',
  'id_mahasiswa',
  'status_kehadiran',
  'keterangan',
  'file_bukti_kehadiran',
  ];

 protected $_casts = [
  'id_kehadiran_mabim' => 'integer',
  'id_mahasiswa'          => 'integer',
  ];

 public function kehadiranMabim(): BelongsTo
 {
  return $this->belongsTo(KehadiranMabim::class, 'id_kehadiran_mabim');
 }

 public function mahasiswa(): BelongsTo
 {
  return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
 }
}

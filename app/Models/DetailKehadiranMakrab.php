<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailKehadiranMakrab extends Model
{
     protected $_fillable = [
  'id_kehadiran_makrab',
  'id_mahasiswa',
  'status_kehadiran',
  'keterangan',
  'file_bukti_kehadiran',
  ];

 protected $_casts = [
  'id_kehadiran_makrab' => 'integer',
  'id_mahasiswa'          => 'integer',
  ];

 public function kehadiranMakrab(): BelongsTo
 {
  return $this->belongsTo(KehadiranMakrab::class, 'id_kehadiran_makrab');
 }

 public function mahasiswa(): BelongsTo
 {
  return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
 }
}

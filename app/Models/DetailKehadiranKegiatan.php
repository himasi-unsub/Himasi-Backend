<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailKehadiranKegiatan extends Model
{
 //
 protected $_fillable = [
  'id_kehadiran_kegiatan',
  'id_mahasiswa',
  'status_kehadiran',
  'keterangan',
  'file_bukti_kehadiran',
  ];

 protected $_casts = [
  'id_kehadiran_kegiatan' => 'integer',
  'id_mahasiswa'          => 'integer',
  ];

 public function kehadiranKegiatan(): BelongsTo
 {
  return $this->belongsTo(KehadiranKegiatan::class, 'id_kehadiran_kegiatan');
 }

 public function mahasiswa(): BelongsTo
 {
  return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
 }
}

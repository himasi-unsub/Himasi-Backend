<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mabim extends Model
{
    //
    protected $fillable = [
        'nama_kegiatan',
        'tahun_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'status',
        'deskripsi',
        'id_dokumen_sertifikat',
        'id_mahasiswa',
     ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function pesertaMabim()
    {
        return $this->hasMany(PesertaMabim::class, 'id_mabim');
    }

    public function dokumenSertifikat()
    {
        return $this->belongsTo(DokumenSertifikat::class, 'id_dokumen_sertifikat');
    }

    public function kehadiranMabim()
    {
        return $this->hasMany(KehadiranMabim::class, 'id_mabim');
    }
}
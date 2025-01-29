<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranKegiatan extends Model
{
    //
    protected $fillable = [
        'nama_pembayaran',
        'nominal_pembayaran',
        'is_active',
        'id_kegiatan_acara',
     ];

    public function kegiatanAcara()
    {
        return $this->belongsTo(KegiatanAcara::class, 'id_kegiatan_acara');
    }

    public function detailPembayaranKegiatan()
    {
        return $this->hasMany(DetailPembayaranKegiatan::class, 'id_pembayaran_kegiatan');
    }
}
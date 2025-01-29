<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaMabim extends Model
{
    //
    protected $fillable = [ 'nilai', 'lulus', 'id_kategori_mabim', 'id_mahasiswa', 'id_mabim', 'hash' ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function kategoriMabim()
    {
        return $this->belongsTo(KategoriMabim::class, 'id_kategori_mabim');
    }

    public function mabim()
    {
        return $this->belongsTo(Mabim::class, 'id_mabim');
    }
}
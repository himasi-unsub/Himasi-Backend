<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaMakrab extends Model
{
    //
    protected $fillable = [ 'id_mahasiswa', 'ukuran_baju', 'status_pembayaran', 'menerima_jahim', 'menerima_sertifikat', 'id_makrab' ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function makrab()
    {
        return $this->belongsTo(Makrab::class, 'id_makrab');
    }

}
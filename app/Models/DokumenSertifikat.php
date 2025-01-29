<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenSertifikat extends Model
{
    //
    protected $fillable = [ 'nama_dokumen', 'jenis_dokumen', 'jenis_kegiatan', 'file' ];
}
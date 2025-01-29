<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StrukturOrganisasiMakrab extends Model
{
    //
    protected $fillable = [
        'id_mahasiswa',
        'jabatan',
        'kontak',
        'id_makrab',
     ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function makrab(): BelongsTo
    {
        return $this->belongsTo(Makrab::class, 'id_makrab');
    }
}

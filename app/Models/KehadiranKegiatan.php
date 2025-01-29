<?php
namespace App\Models;

use App\Jobs\UpdateKehadiranKegiatanStatusJob;
use function Illuminate\Events\queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KehadiranKegiatan extends Model
{
    // use Queueable;
    //
    protected $fillable = [
        'nama_kehadiran',
        'keterangan',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_mulai',
        'jam_selesai',
        'kode_kehadiran',
        'is_active',
        'id_kegiatan_acara',
     ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'is_active'       => 'boolean',
     ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(queueable(function ($kehadiran) {
            UpdateKehadiranKegiatanStatusJob::dispatch($kehadiran);
        }));

        static::updated(queueable(function ($kehadiran) {
            UpdateKehadiranKegiatanStatusJob::dispatch($kehadiran);
        }));
    }

    public function kegiatanAcara(): BelongsTo
    {
        return $this->belongsTo(KegiatanAcara::class, 'id_kegiatan_acara');
    }

    public function detailKehadiranKegiatan(): HasMany
    {
        return $this->hasMany(DetailKehadiranKegiatan::class, 'id_kehadiran_kegiatan');
    }
}
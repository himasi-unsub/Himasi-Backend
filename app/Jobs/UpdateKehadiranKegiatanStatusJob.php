<?php
namespace App\Jobs;

use App\Models\KehadiranKegiatan;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateKehadiranKegiatanStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $_kehadiran;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(KehadiranKegiatan $kehadiran)
    {
        $this->kehadiran = $kehadiran;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Log::info("Job dijalankan untuk kehadiran: {$this->kehadiran->id}");

        // Ambil waktu saat ini
        $now = Carbon::now();

        // Perbarui status is_active menjadi false jika melewati tanggal_selesai dan jam_selesai
        if (
            $this->kehadiran->tanggal_selesai < $now->toDateString() ||
            ($now->toDateString() == $this->kehadiran->tanggal_selesai &&
                $this->kehadiran->jam_selesai <= $now->toTimeString()
            )
        ) {
            $this->kehadiran->update([ 'is_active' => 0 ]);
            \Log::info("Status is_active diupdate menjadi false untuk kehadiran ID: {$this->kehadiran->id}");
        }

    }
}

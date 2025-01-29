<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\KehadiranKegiatan;

/*
* Command untuk meng-update status is_active pada kehadiran berdasarkan tanggal_selesai dan jam_selesai
* Update status is_active pada kehadiran berdasarkan tanggal_selesai dan jam_selesai
*/
class UpdateKehadiranKegiatanStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kehadiran-kegiatan:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status is_active pada kehadiran berdasarkan tanggal_selesai dan jam_selesai';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $kehadiran = KehadiranKegiatan::where('is_active', true)
            ->where(function ($query) use ($now) {
                $query->where('tanggal_selesai', '<', $now->toDateString())
                      ->orWhere(function ($query) use ($now) {
                          $query->where('tanggal_selesai', '=', $now->toDateString())
                                ->where('jam_selesai', '<=', $now->toTimeString());
                      });
            });

            $res = $kehadiran->update(['is_active' => false]);

            // $nama_kehadiran = $kehadiran->get()->nama_kehadiran;

        $this->info("Berhasil mengupdate status kehadiran $res");
    }
}
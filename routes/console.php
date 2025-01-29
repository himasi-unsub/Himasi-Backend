<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('kehadiran-kegiatan:update-status')
    ->everyMinute()
    // ->appendOutputTo(storage_path('logs/kehadiran-kegiatan-update-status.log'))
    ->withoutOverlapping()
    ->onOneServer()
    ->runInBackground()
    ->description('Update status is_active pada kehadiran berdasarkan tanggal_selesai dan jam_selesai');
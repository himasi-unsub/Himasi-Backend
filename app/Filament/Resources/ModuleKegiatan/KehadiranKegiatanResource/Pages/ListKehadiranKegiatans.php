<?php

namespace App\Filament\Resources\ModuleKegiatan\KehadiranKegiatanResource\Pages;

use App\Filament\Resources\ModuleKegiatan\KehadiranKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKehadiranKegiatans extends ListRecords
{
    protected static string $resource = KehadiranKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

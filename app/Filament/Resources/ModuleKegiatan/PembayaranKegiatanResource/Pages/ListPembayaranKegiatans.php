<?php

namespace App\Filament\Resources\ModuleKegiatan\PembayaranKegiatanResource\Pages;

use App\Filament\Resources\ModuleKegiatan\PembayaranKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPembayaranKegiatans extends ListRecords
{
    protected static string $resource = PembayaranKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

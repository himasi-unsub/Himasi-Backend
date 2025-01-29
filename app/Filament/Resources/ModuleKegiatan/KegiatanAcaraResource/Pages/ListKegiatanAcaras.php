<?php

namespace App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource\Pages;

use App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKegiatanAcaras extends ListRecords
{
    protected static string $resource = KegiatanAcaraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

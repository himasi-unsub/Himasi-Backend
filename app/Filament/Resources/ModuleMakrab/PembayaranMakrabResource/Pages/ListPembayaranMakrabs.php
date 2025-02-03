<?php

namespace App\Filament\Resources\ModuleMakrab\PembayaranMakrabResource\Pages;

use App\Filament\Resources\ModuleMakrab\PembayaranMakrabResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPembayaranMakrabs extends ListRecords
{
    protected static string $resource = PembayaranMakrabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

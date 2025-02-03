<?php

namespace App\Filament\Resources\ModuleMakrab\KehadiranMakrabResource\Pages;

use App\Filament\Resources\ModuleMakrab\KehadiranMakrabResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKehadiranMakrabs extends ListRecords
{
    protected static string $resource = KehadiranMakrabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

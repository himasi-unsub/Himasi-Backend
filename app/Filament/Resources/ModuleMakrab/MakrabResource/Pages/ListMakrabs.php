<?php

namespace App\Filament\Resources\ModuleMakrab\MakrabResource\Pages;

use App\Filament\Resources\ModuleMakrab\MakrabResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMakrabs extends ListRecords
{
    protected static string $resource = MakrabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

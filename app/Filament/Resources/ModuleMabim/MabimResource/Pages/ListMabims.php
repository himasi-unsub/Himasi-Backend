<?php

namespace App\Filament\Resources\ModuleMabim\MabimResource\Pages;

use App\Filament\Resources\ModuleMabim\MabimResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMabims extends ListRecords
{
    protected static string $resource = MabimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
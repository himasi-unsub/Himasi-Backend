<?php

namespace App\Filament\Resources\ModuleMabim\KehadiranMabimResource\Pages;

use App\Filament\Resources\ModuleMabim\KehadiranMabimResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKehadiranMabims extends ListRecords
{
    protected static string $resource = KehadiranMabimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

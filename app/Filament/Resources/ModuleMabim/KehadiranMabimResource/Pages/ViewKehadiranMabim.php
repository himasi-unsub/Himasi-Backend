<?php

namespace App\Filament\Resources\ModuleMabim\KehadiranMabimResource\Pages;

use App\Filament\Resources\ModuleMabim\KehadiranMabimResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKehadiranMabim extends ViewRecord
{
    protected static string $resource = KehadiranMabimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

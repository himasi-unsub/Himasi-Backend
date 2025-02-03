<?php

namespace App\Filament\Resources\ModuleMakrab\KehadiranMakrabResource\Pages;

use App\Filament\Resources\ModuleMakrab\KehadiranMakrabResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKehadiranMakrab extends ViewRecord
{
    protected static string $resource = KehadiranMakrabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

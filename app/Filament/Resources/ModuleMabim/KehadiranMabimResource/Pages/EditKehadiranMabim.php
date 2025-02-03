<?php

namespace App\Filament\Resources\ModuleMabim\KehadiranMabimResource\Pages;

use App\Filament\Resources\ModuleMabim\KehadiranMabimResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKehadiranMabim extends EditRecord
{
    protected static string $resource = KehadiranMabimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

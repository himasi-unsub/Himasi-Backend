<?php

namespace App\Filament\Resources\ModuleMakrab\KehadiranMakrabResource\Pages;

use App\Filament\Resources\ModuleMakrab\KehadiranMakrabResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKehadiranMakrab extends EditRecord
{
    protected static string $resource = KehadiranMakrabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

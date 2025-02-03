<?php

namespace App\Filament\Resources\ModuleMakrab\PembayaranMakrabResource\Pages;

use App\Filament\Resources\ModuleMakrab\PembayaranMakrabResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPembayaranMakrab extends EditRecord
{
    protected static string $resource = PembayaranMakrabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

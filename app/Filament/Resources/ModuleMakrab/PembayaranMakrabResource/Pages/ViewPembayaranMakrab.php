<?php

namespace App\Filament\Resources\ModuleMakrab\PembayaranMakrabResource\Pages;

use App\Filament\Resources\ModuleMakrab\PembayaranMakrabResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPembayaranMakrab extends ViewRecord
{
    protected static string $resource = PembayaranMakrabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

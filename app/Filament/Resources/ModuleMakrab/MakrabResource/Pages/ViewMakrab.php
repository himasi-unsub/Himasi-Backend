<?php

namespace App\Filament\Resources\ModuleMakrab\MakrabResource\Pages;

use App\Filament\Resources\ModuleMakrab\MakrabResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMakrab extends ViewRecord
{
    protected static string $resource = MakrabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\EditAction::make(),
        ];
    }
}

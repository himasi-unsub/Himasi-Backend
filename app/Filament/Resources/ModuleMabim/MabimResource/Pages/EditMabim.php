<?php

namespace App\Filament\Resources\ModuleMabim\MabimResource\Pages;

use App\Filament\Resources\ModuleMabim\MabimResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMabim extends EditRecord
{
    protected static string $resource = MabimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ModuleMakrab\MakrabResource\Pages;

use App\Filament\Resources\ModuleMakrab\MakrabResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMakrab extends EditRecord
{
    protected static string $resource = MakrabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

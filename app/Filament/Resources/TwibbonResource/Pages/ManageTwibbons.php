<?php

namespace App\Filament\Resources\TwibbonResource\Pages;

use App\Filament\Resources\TwibbonResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTwibbons extends ManageRecords
{
    protected static string $resource = TwibbonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

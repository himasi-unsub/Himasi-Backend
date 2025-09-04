<?php

namespace App\Filament\TwibbonizerClient\Resources\TwibbonResource\Pages;

use App\Filament\TwibbonizerClient\Resources\TwibbonResource;
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

<?php
namespace App\Filament\Resources\ModuleMabim\MabimResource\Pages;

use App\Filament\Resources\ModuleMabim\MabimResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMabim extends ViewRecord
{
    protected static string $resource = MabimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
         ];
    }
}
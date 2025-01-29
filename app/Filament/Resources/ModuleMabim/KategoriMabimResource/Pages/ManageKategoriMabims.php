<?php

namespace App\Filament\Resources\ModuleMabim\KategoriMabimResource\Pages;

use App\Filament\Resources\ModuleMabim\KategoriMabimResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKategoriMabims extends ManageRecords
{
    protected static string $resource = KategoriMabimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
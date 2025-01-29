<?php

namespace App\Filament\Resources\DokumenSertifikatResource\Pages;

use App\Filament\Resources\DokumenSertifikatResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDokumenSertifikats extends ManageRecords
{
    protected static string $resource = DokumenSertifikatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

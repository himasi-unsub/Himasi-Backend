<?php

namespace App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource\Pages;

use App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKegiatanAcara extends EditRecord
{
    protected static string $resource = KegiatanAcaraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ModuleKegiatan\KehadiranKegiatanResource\Pages;

use App\Filament\Resources\ModuleKegiatan\KehadiranKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKehadiranKegiatan extends EditRecord
{
    protected static string $resource = KehadiranKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

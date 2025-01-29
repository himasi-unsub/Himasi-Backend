<?php
namespace App\Filament\Resources\ModuleKegiatan\KehadiranKegiatanResource\Pages;

use App\Filament\Resources\ModuleKegiatan\KehadiranKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKehadiranKegiatan extends ViewRecord
{
    protected static string $resource = KehadiranKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
         ];
    }
}

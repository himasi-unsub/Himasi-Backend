<?php
namespace App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource\Pages;

use App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKegiatanAcara extends ViewRecord
{
    protected static string $resource = KegiatanAcaraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
         ];
    }
}

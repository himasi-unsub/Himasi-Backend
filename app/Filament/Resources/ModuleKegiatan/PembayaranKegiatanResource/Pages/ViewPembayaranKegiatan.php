<?php
namespace App\Filament\Resources\ModuleKegiatan\PembayaranKegiatanResource\Pages;

use App\Filament\Resources\ModuleKegiatan\PembayaranKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPembayaranKegiatan extends ViewRecord
{
    protected static string $resource = PembayaranKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
         ];
    }
}

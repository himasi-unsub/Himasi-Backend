<?php

namespace App\Filament\Resources\ModuleKegiatan\PesertaKegiatanResource\Pages;

use App\Filament\Resources\ModuleKegiatan\PesertaKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePesertaKegiatans extends ManageRecords
{
    protected static string $resource = PesertaKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

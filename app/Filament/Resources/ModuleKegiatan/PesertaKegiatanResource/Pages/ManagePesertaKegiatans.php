<?php

namespace App\Filament\Resources\ModuleKegiatan\PesertaKegiatanResource\Pages;

use App\Filament\Resources\ModuleKegiatan\PesertaKegiatanResource;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Resources\Pages\ManageRecords;

class ManagePesertaKegiatans extends ManageRecords
{
    protected static string $resource = PesertaKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make('importExcel')
                ->label('Import Excel')
                ->sampleExcel(
                    sampleData: [
                        'id_kegiatan_acara'           => '1',
                        'id_mahasiswa'         => '1',
                    ],
                    fileName: 'peserta-kegiatan-example-data.xlsx',
                    sampleButtonLabel: 'Download Sample',
                    customiseActionUsing: fn(Action $action) => $action->color('secondary')
                        ->icon('heroicon-m-clipboard')
                        ->requiresConfirmation(),
                ),
            Actions\CreateAction::make(),
        ];
    }
}

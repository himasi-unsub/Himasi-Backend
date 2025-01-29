<?php
namespace App\Filament\Resources\MahasiswaResource\Pages;

use App\Filament\Resources\MahasiswaResource;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Resources\Pages\ManageRecords;

class ManageMahasiswas extends ManageRecords
{
    protected static string $resource = MahasiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make('importExcel')
                ->label('Import Excel')
                ->sampleExcel(
                    sampleData: [
                        'npm'            => '1234567890',
                        'nama'           => 'John Doe',
                        'tahun_angkatan' => '2020',
                     ],
                    fileName: 'mahasiswa.xlsx',
                    sampleButtonLabel: 'Download Sample',
                    customiseActionUsing: fn(Action $action) => $action->color('secondary')
                        ->icon('heroicon-m-clipboard')
                        ->requiresConfirmation(),
                ),
            Actions\ImportAction::make('importCsv')
                ->importer(\App\Filament\Imports\MahasiswaImporter::class)
                ->label('Import CSV')
                ->icon('heroicon-o-arrow-down-tray'),
            Actions\CreateAction::make(),
         ];
    }
}
<?php
namespace App\Filament\Resources\ModuleMabim\PesertaMabimResource\Pages;

use App\Filament\Resources\ModuleMabim\PesertaMabimResource;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Resources\Pages\ManageRecords;

class ManagePesertaMabims extends ManageRecords
{
    protected static string $resource = PesertaMabimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make('importExcel')
                ->label('Import Excel')
                ->sampleExcel(
                    sampleData: [
                        'id_mabim'          => '1',
                        'nilai'             => '90',
                        'lulus'             => '1',
                        'id_kategori_mabim' => '1',
                        'id_mahasiswa'      => '1',
                     ],
                    fileName: 'peserta-mabims-example-data.xlsx',
                    sampleButtonLabel: 'Download Sample',
                    customiseActionUsing: fn(Action $action) => $action->color('secondary')
                        ->icon('heroicon-m-clipboard')
                        ->requiresConfirmation(),
                ),
            Actions\CreateAction::make(),
         ];
    }
}
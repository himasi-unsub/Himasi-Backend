<?php
namespace App\Filament\Resources\ModuleMakrab\PesertaMakrabResource\Pages;

use App\Filament\Resources\ModuleMakrab\PesertaMakrabResource;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Resources\Pages\ManageRecords;

class ManagePesertaMakrabs extends ManageRecords
{
    protected static string $resource = PesertaMakrabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make('importExcel')
                ->label('Import Excel')
                ->sampleExcel(
                    sampleData: [
                        'id_makrab'           => '1',
                        'ukuran_baju'         => 'M',
                        'status_pembayaran'   => 'Lunas',
                        'menerima_jahim'      => 'Ya',
                        'menerima_sertifikat' => 'Ya',
                        'id_mahasiswa'        => '1',
                     ],
                    fileName: 'peserta-makrab-example-data.xlsx',
                    sampleButtonLabel: 'Download Sample',
                    customiseActionUsing: fn(Action $action) => $action->color('secondary')
                        ->icon('heroicon-m-clipboard')
                        ->requiresConfirmation(),
                ),
            Actions\CreateAction::make(),
         ];
    }
}
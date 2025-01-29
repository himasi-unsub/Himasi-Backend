<?php

namespace App\Filament\Imports;

use App\Models\Mahasiswa;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MahasiswaImporter extends Importer
{
    protected static ?string $model = Mahasiswa::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('npm')
                ->requiredMapping()
                ->rules(['required', 'max:10']),
            ImportColumn::make('nama')
                ->requiredMapping()
                ->rules(['required', 'max:50']),
            ImportColumn::make('tahun_angkatan')
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Mahasiswa
    {
        // return Mahasiswa::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Mahasiswa();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your mahasiswa import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}

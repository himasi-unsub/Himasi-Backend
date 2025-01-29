<?php
namespace App\Filament\Resources\ModuleMakrab\MakrabResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class PesertaMakrabRelationManager extends RelationManager
{
    protected static string $relationship = 'pesertaMakrab';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_mahasiswa')
                    ->relationship('mahasiswa', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('id_makrab')
                    ->relationship('makrab', 'nama_kegiatan')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('ukuran_baju')
                    ->options([
                        'S'   => 'S',
                        'M'   => 'M',
                        'L'   => 'L',
                        'XL'  => 'XL',
                        'XXL' => 'XXL',
                     ]),
                Forms\Components\Select::make('status_pembayaran')
                    ->options([
                        'Lunas'       => 'Lunas',
                        'Belum Lunas' => 'Belum Lunas',
                        'Tidak Bayar' => 'Tidak Bayar',
                        'Tidak Ikut'  => 'Tidak Ikut',
                        'Selesai'     => 'Selesai',
                     ])
                    ->default('Belum Lunas')
                    ->required(),
                Forms\Components\Toggle::make('menerima_jahim')
                    ->default(false)
                    ->required(),
                Forms\Components\Toggle::make('menerima_sertifikat')
                    ->default(false)
                    ->required(),
             ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('mahasiswa.nama')
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.npm')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mahasiswa.nama')
                    ->wrap()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_pembayaran')
                    ->sortable()
                    ->toggleable(),
             ])
            ->filters([
                SelectFilter::make('status_pembayaran')
                    ->options([
                        'Lunas'       => 'Lunas',
                        'Belum Lunas' => 'Belum Lunas',
                        'Tidak Bayar' => 'Tidak Bayar',
                        'Tidak Ikut'  => 'Tidak Ikut',
                        'Selesai'     => 'Selesai',
                     ]),
             ])
            ->headerActions([
                \EightyNine\ExcelImport\Tables\ExcelImportRelationshipAction::make('importExcel')
                    ->label('Import Excel')
                    ->sampleExcel(
                        sampleData: [
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
                Tables\Actions\CreateAction::make(),
             ])
            ->actions([
                Tables\Actions\ActionGroup::make([

                    Tables\Actions\Action::make('generate-sertifikat')
                        ->label('Generate Sertifikat')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->url(fn($record) => route('generate-sertifikat', [ 'kegiatan' => 'makrab', 'peserta' => $record->id ])),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                 ]),
             ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('generate-sertifikat')
                    ->label('Generate Sertifikat')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->requiresConfirmation()
                    ->closeModalByClickingAway()
                    ->closeModalByEscaping()
                    ->modalDescription('Apakah Anda yakin ingin mengenerate sertifikat peserta yang dipilih?')
                    ->action(
                        fn(Collection $records = null) => redirect()->route('bulk-generate-sertifikat', [ 'kegiatan' => 'makrab', 'records' => urlencode(json_encode($records->pluck('id')->toArray())) ])
                    ),
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()
                        ->exports(
                            [
                                ExcelExport::make()
                                    ->withColumns([
                                        Column::make('id')->heading('ID'),
                                        Column::make('mahasiswa.npm')->heading('NPM'),
                                        Column::make('mahasiswa.nama')->heading('Nama'),
                                        Column::make('makrab.tahun_kegiatan')->heading('Tahun Kegiatan'),
                                        Column::make('ukuran_baju')->heading('Ukuran Baju'),
                                        Column::make('status_pembayaran')->heading('Status Pembayaran'),
                                        Column::make('menerima_jahim')->heading('Menerima Jahim'),
                                        Column::make('menerima_sertifikat')->heading('Menerima Sertifikat'),
                                     ]),
                             ]
                        ),
                    Tables\Actions\DeleteBulkAction::make(),
                 ]),
             ]);
    }
}
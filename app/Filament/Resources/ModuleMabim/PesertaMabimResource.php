<?php
namespace App\Filament\Resources\ModuleMabim;

use App\Filament\Resources\ModuleMabim\PesertaMabimResource\Pages;
use App\Models\PesertaMabim;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class PesertaMabimResource extends Resource
{
    protected static ?string $model = PesertaMabim::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Kegiatan Mabim';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_mabim')
                    ->label('Pilih Kegiatan')
                    ->relationship('mabim', 'nama_kegiatan')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('id_mahasiswa')
                    ->relationship('mahasiswa', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('id_kategori_mabim')
                    ->relationship('kategoriMabim', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('nilai')
                    ->numeric(),
                Forms\Components\Toggle::make('lulus')
                    ->required()
                    ->columnSpanFull(),
             ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.npm')
                    ->label('NPM')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('mahasiswa.nama')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('mabim.tahun_kegiatan')
                    ->label('Tahun Kegiatan')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kategoriMabim.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nilai')
                    ->sortable(),
                ToggleIconColumn::make('lulus')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
             ])
            ->filters([
                SelectFilter::make('id_mabim')
                    ->label('Tahun Kegiatan Mabim')
                    ->relationship('mabim', 'tahun_kegiatan')
                    ->preload()
                    ->searchable(),
                SelectFilter::make('id_kategori_mabim')
                    ->label('Kategori Mabim')
                    ->relationship('kategoriMabim', 'nama')
                    ->preload()
                    ->searchable(),
                SelectFilter::make('lulus')
                    ->options([
                        0 => 'Tidak Lulus',
                        1 => 'Lulus',
                     ]),
             ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('generate-sertifikat')
                        ->label('Generate Sertifikat')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->url(fn($record) => route('generate-sertifikat', [ 'kegiatan' => 'mabim', 'peserta' => $record->id ]))
                        ->visible(fn($record) => $record->lulus),
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
                        fn(Collection $records = null) => redirect()->route('bulk-generate-sertifikat', [ 'kegiatan' => 'mabim', 'records' => urlencode(json_encode($records->pluck('id')->toArray())) ])
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
                                        Column::make('mabim.tahun_kegiatan')->heading('Tahun Kegiatan'),
                                        Column::make('kategoriMabim.nama')->heading('Kategori Mabim'),
                                        Column::make('nilai')->heading('Nilai'),
                                        Column::make('lulus')->heading('Lulus'),
                                     ]),
                             ]
                        ),
                    Tables\Actions\DeleteBulkAction::make(),
                 ]),
             ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePesertaMabims::route('/'),
         ];
    }
}

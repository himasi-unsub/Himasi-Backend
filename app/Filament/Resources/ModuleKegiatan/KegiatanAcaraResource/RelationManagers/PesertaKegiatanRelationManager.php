<?php
namespace App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class PesertaKegiatanRelationManager extends RelationManager
{
    protected static string $relationship = 'pesertaKegiatan';

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return $ownerRecord->has_peserta;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_mahasiswa')
                    ->label('Mahasiswa')
                    ->relationship('mahasiswa', 'nama')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),
             ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.npm')
                    ->label('NPM'),
                Tables\Columns\TextColumn::make('mahasiswa.nama')
                    ->label('Nama'),
             ])
            ->filters([
                //
             ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
             ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('generate-sertifikat')
                        ->label('Generate Sertifikat')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->url(fn($record) => route('generate-sertifikat', [ 'kegiatan' => 'lainnya', 'peserta' => $record->id ]))
                        ->visible(fn($record) => $record->kegiatanAcara->id_dokumen_sertifikat != null),
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
                    )
                    ->visible(fn(KegiatanAcara $ownerRecords = null) => $ownerRecords->id_dokumen_sertifikat != null),
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                 ]),
             ]);
    }
}

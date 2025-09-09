<?php

namespace App\Filament\Resources\ModuleKegiatan;

use App\Filament\Resources\ModuleKegiatan\PesertaKegiatanResource\Pages;
use App\Filament\Resources\ModuleKegiatan\PesertaKegiatanResource\RelationManagers;
use App\Models\KegiatanAcara;
use App\Models\PesertaKegiatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesertaKegiatanResource extends Resource
{
    protected static ?string $model = PesertaKegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Kegiatan atau Acara';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_mahasiswa')
                    ->relationship('mahasiswa', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('id_kegiatan_acara')
                    ->relationship('kegiatanAcara', 'nama_kegiatan')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.npm')
                    ->label('NPM')
                    ->sortable(),
                Tables\Columns\TextColumn::make('mahasiswa.nama')
                    ->label('Nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kegiatanAcara.nama_kegiatan')
                    ->label('Kegiatan / Acara')
                    ->sortable(),
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
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('generate-sertifikat')
                        ->label('Generate Sertifikat')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->requiresConfirmation()
                        ->closeModalByClickingAway()
                        ->closeModalByEscaping()
                        ->modalDescription('Apakah Anda yakin ingin mengenerate sertifikat peserta yang dipilih?')
                        ->action(fn($record) => redirect()->route('generate-sertifikat', ['kegiatan' => 'kegiatan', 'peserta' => $record->id])),
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
                        fn(Collection $records = null) => redirect()->route('bulk-generate-sertifikat', ['kegiatan' => 'kegiatan', 'records' => urlencode(json_encode($records->pluck('id')->toArray()))])
                    ),
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePesertaKegiatans::route('/'),
        ];
    }
}
